<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\Vendor;
use Carbon\Carbon;

class NinjaVanAPIHelper
{
    protected $api_url;
    protected $api_key;
    protected $api_client_id;
    protected $access_token;
    
    public $priceBreakdown = [], $quotation = [], $total_delivery_fee = 0.0, $sender,  $recipient;

    // Available service levels with their delivery timelines
    const SERVICE_LEVELS = [
        'Standard' => '+3 days',
        'Express' => '+2 days',
        'Sameday' => '+0 days',
        'Nextday' => '+1 day'
    ];

    public function __construct()
    {
        $this->api_url = config('app.ninjavan.api_url');
        $this->api_key = config('app.ninjavan.client_secret');
        $this->api_client_id = config('app.ninjavan.client_id');
        $this->access_token = config('app.ninjavan.access_token');
    }

    /**
     * Get shipping quotation with customer-selected options
     */
    public function getCustomerShippingQuote(Order $order, int $vendorId, string $serviceLevel, string $pickupDate, string $pickupTime, string $pickupInstructions = '', string $deliveryInstructions = '') {
        try {
            $this->validateServiceLevel($serviceLevel);
            
            $vendor = Vendor::with('vendorbusinessdetails')->findOrFail($vendorId);
            $this->validateCoordinates($order, $vendor);
            
            $deliveryStartDate = $this->calculateDeliveryDate($pickupDate, $serviceLevel);
            $timeSlot = $this->parseTimeSlot($pickupTime);

            $payload = [
                "service_type" => "Marketplace",
                "service_level" => $serviceLevel,
                "parcel_job" => $this->buildParcelJob(
                    $order,
                    $vendor,
                    $pickupDate,
                    $timeSlot,
                    $deliveryStartDate,
                    $pickupInstructions,
                    $deliveryInstructions
                )
            ];

            Log::debug('NinjaVan Customer Shipping Request', $payload);
            
            $response = $this->makeApiRequest($payload, 'quotation');
            $this->processResponse($response, $vendor, $order->user);
            
            return $this;
            
        } catch (\Exception $e) {
            Log::error('NinjaVan Shipping Error: ' . $e->getMessage());
            throw new \Exception('Shipping calculation failed: ' . $e->getMessage());
        }
    }

    /**
     * Calculate delivery cost from quotation
     */
    public function getCalculatedCost(): array
    {
        if (empty($this->quotation)) {
            throw new \Exception('No quotation data available');
        }

        $this->priceBreakdown = collect($this->quotation)
            ->pluck('quote.price_breakdown')
            ->toArray();

        $this->total_delivery_fee = collect($this->quotation)
            ->sum('quote.price_breakdown.total_amount');

        return [
            'total' => $this->total_delivery_fee,
            'breakdown' => $this->priceBreakdown
        ];
    }

    protected function buildParcelJob(
        Order $order,
        Vendor $vendor,
        string $pickupDate,
        array $timeSlot,
        string $deliveryStartDate,
        string $pickupInstructions,
        string $deliveryInstructions
    ): array {
        return [
            "is_pickup_required" => true,
            "pickup_service_type" => "scheduled",
            "pickup_service_level" => "standard",
            "pickup_date" => $pickupDate,
            "pickup_timeslot" => [
                "start_time" => $timeSlot['start'],
                "end_time" => $timeSlot['end'],
                "timezone" => "Asia/Manila",
            ],
            "pickup_instructions" => $pickupInstructions,
            "delivery_instructions" => $deliveryInstructions,
            "delivery_start_date" => $deliveryStartDate,
            "cash_on_delivery" => [
                "amount" => (float) $order->grand_total,
                "currency" => "PHP"
            ],
            "pickup_address" => $this->buildVendorAddress($vendor->vendorbusinessdetails),
            "delivery_address" => $this->buildCustomerAddress($order),
            "dimensions" => [
                "weight" => (float) ($order->total_weight ?: 1.0),
            ],
            "items" => [
                [
                    "item_description" => "Order #" . $order->id,
                    "quantity" => 1,
                    "is_dangerous_good" => false
                ]
            ]
        ];
    }

    protected function buildVendorAddress($vendorDetails): array
    {
        return [
            "name" => $vendorDetails->shop_name ?? 'Vendor',
            "contact_number" => $vendorDetails->shop_phone ?? '0000000000',
            "email" => $vendorDetails->vendor->email ?? 'vendor@example.com',
            "address1" => $vendorDetails->shop_address,
            "city" => $vendorDetails->shop_city,
            "state" => $vendorDetails->shop_state,
            "country" => $vendorDetails->country,
            "postcode" => $vendorDetails->shop_pincode,
            "latitude" => (float) $vendorDetails->lat,
            "longitude" => (float) $vendorDetails->long,
        ];
    }

    protected function buildCustomerAddress(Order $order): array
    {
        return [
            "name" => $order->name,
            "contact_number" => $order->mobile,
            "email" => $order->email,
            "address1" => $order->address,
            "city" => $order->city,
            "state" => $order->state,
            "country" => $order->country,
            "postcode" => $order->pincode,
            "latitude" => (float) $order->lat,
            "longitude" => (float) $order->lng,
        ];
    }

    protected function validateServiceLevel(string $serviceLevel): void
    {
        if (!array_key_exists($serviceLevel, self::SERVICE_LEVELS)) {
            throw new \Exception("Invalid service level selected");
        }
    }

    protected function calculateDeliveryDate(string $pickupDate, string $serviceLevel): string
    {
        return Carbon::parse($pickupDate)
            ->modify(self::SERVICE_LEVELS[$serviceLevel])
            ->format('Y-m-d');
    }

    protected function parseTimeSlot(string $pickupTime): array
    {
        // Assuming format like "09:00-12:00" or "13:00-17:00"
        $times = explode('-', $pickupTime);
        
        return [
            'start' => $times[0] ?? '09:00',
            'end' => $times[1] ?? '17:00'
        ];
    }

    protected function validateCoordinates(Order $order, Vendor $vendor): void
    {
        $vendorDetails = $vendor->vendorbusinessdetails;
        
        if (empty($vendorDetails->lat) || empty($vendorDetails->long)) {
            throw new \Exception("Vendor coordinates are missing");
        }

        if (empty($order->lat) || empty($order->lng)) {
            throw new \Exception("Customer delivery coordinates are missing");
        }
    }

    protected function makeApiRequest(array $payload, string $endpoint): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
            'Content-Type' => 'application/json',
        ])->post("{$this->api_url}/{$endpoint}", $payload);

        if ($response->failed()) {
            throw new \Exception("NinjaVan API Error: " . $response->body());
        }

        return $response->json();
    }

    protected function processResponse(array $response, Vendor $vendor, $user): void
    {
        $this->quotation = $response;
        $this->sender = $vendor;
        $this->recipient = $user;
    }
}