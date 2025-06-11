<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Order;   

class NinjaVanService
{
    protected $client_id;
    protected $client_key;
    protected $access_token;

    public function __construct()
    {
        $this->client_id = config('ninjavan.client_id');
        $this->client_key = config('ninjavan.client_key');
        $this->api_url = config('ninjavan.api_url');
        $this->getAccessToken(); 
    }

    protected function getAccessToken()
    {
        $response = Http::post('https://api-sandbox.ninjavan.co/SG/2.0/oauth/access_token', [
            'client_id' => $this->client_id,
            'client_key' => $this->client_key,
            'grant_type' => 'client_credentials',
        ]);

        $this->access_token = $response['access_token'] ?? null;
    }

    public function createOrder(array $data)
    {
        // Assuming $data contains both 'order' and 'userInput' keys
        $order = $data['order'];
        $userInput = $data['userInput'];

        $payload = $this->buildPayload($order, $userInput);

        $response = Http::withToken($this->access_token)
            ->post('https://api-sandbox.ninjavan.co/sg/4.2/orders', $payload);

        return $response->json();
    }

    protected function buildPayload(array $order, array $userInput): array
    {
        $deliveryStartDate = $this->calculateDeliveryStartDate(
            $userInput['service_level'],
            $userInput['pickup_date']
        );

        return [
            "service_type" => "Marketplace",
            "service_level" => $userInput['service_level'],
            "reference" => [
                "merchant_order_number" => $order['order_number'],
            ],
            "from" => $order['pickup'],
            "to" => $order['recipient'],
            "parcel_job" => [
                "is_pickup_required" => true,
                "pickup_service_type" => "Scheduled",
                "pickup_service_level" => $userInput['service_level'],
                "pickup_date" => $userInput['pickup_date'],
                "pickup_timeslot" => [
                    "start_time" => $userInput['pickup_time']['start'],
                    "end_time" => $userInput['pickup_time']['end'],
                    "timezone" => "Asia/Kuala_Lumpur",
                ],
                "pickup_instructions" => $userInput['pickup_instructions'] ?? "",
                "delivery_instructions" => $userInput['delivery_instructions'] ?? "",
                "delivery_start_date" => $deliveryStartDate,
                "delivery_timeslot" => [
                    "start_time" => "09:00",
                    "end_time" => "22:00",
                    "timezone" => "Asia/Kuala_Lumpur",
                ],
                "dimensions" => [
                    "weight" => $order['total_weight'] ?? 1.0,
                ],
                "items" => $order['items'],
            ]
        ];
    }

    protected function calculateDeliveryStartDate(string $serviceLevel, string $pickupDate): string
    {
        $pickup = Carbon::parse($pickupDate);

        return match (strtolower($serviceLevel)) {
            'standard' => $pickup->copy()->addDays(2)->toDateString(),
            'express', 'nextday' => $pickup->copy()->addDay()->toDateString(),
            'sameday' => $pickup->toDateString(),
            default => $pickup->copy()->addDays(2)->toDateString(),
        };
    }

    public function trackOrder(string $trackingId)
    {
        return Http::withToken($this->access_token)
            ->get("https://api-sandbox.ninjavan.co/SG/2.0/track", [
                'tracking_id' => $trackingId,
            ]);
    }

    public function schedulePickup(array $pickupData)
    {
        return Http::withToken($this->access_token)
            ->post('https://api-sandbox.ninjavan.co/SG/4.1/collections', $pickupData);
    }
}
?>