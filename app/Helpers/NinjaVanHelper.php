<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class NinjaVanHelper
{
    protected $processNinjaVan;
    protected $ninjaVanResponse;
    protected $bearer_token;
    protected $sandbox_url;
    /**
     * Calculate shipping charges based on actual weight and destination zone.
     *
     * @param float $weightKg          Actual weight in kilograms
     * @param string $province         Destination province (e.g., 'Cebu', 'Metro Manila')
     * @return float
     */
    public static function calculateShippingCharge(float $weightKg, string $province): float
    {
        // Round up to next full kilogram
        $roundedWeight = ceil($weightKg);

        $rates = [
            'MM' => [
                'base_1kg' => 60,
                'base_3kg' => 80,
                'additional_per_kg' => 25,
            ],
            'GMA/NLZ/SLZ' => [
                'base_1kg' => 110,
                'base_3kg' => 180,
                'additional_per_kg' => 80,
            ],
            'VIS/MIN' => [
                'base_1kg' => 110,
                'base_3kg' => 180,
                'additional_per_kg' => 80,
            ],
        ];

        // Normalize zone using province
        $zone = self::getZoneFromProvince($province);

        if ($zone === null) {
            throw new \InvalidArgumentException("Invalid province or destination zone: $province");
        }

        // Map NLZ, SLZ, VIS, MIN to their respective rate keys
        if (in_array($zone, ['NLZ', 'SLZ'])) {
            $rateKey = 'GMA/NLZ/SLZ';
        } elseif (in_array($zone, ['VIS', 'MIN'])) {
            $rateKey = 'VIS/MIN';
        } else {
            $rateKey = $zone;
        }

        if (!isset($rates[$rateKey])) {
            throw new \InvalidArgumentException("Invalid rate key for zone: $rateKey");
        }

        $zoneRates = $rates[$rateKey];

        if ($roundedWeight <= 1) {
            return $zoneRates['base_1kg'];
        } elseif ($roundedWeight <= 3) {
            return $zoneRates['base_3kg'];
        } else {
            $extraKg = $roundedWeight - 3;
            return $zoneRates['base_3kg'] + ($extraKg * $zoneRates['additional_per_kg']);
        }
    }

    /**
     * Map province to logistics zone.
     *
     * @param string $province
     * @return string|null
     */
    public static function getZoneFromProvince(string $province): ?string
    {
        $province = ucwords(strtolower(trim($province)));

        return self::$provinceZoneMap[$province] ?? null;
    }

    public static function calculateFromAddress(float $weightKg, array $address): float
    {
    return self::calculateShippingCharge($weightKg, $address['state']);
    }

    /**
     * Full province to zone map.
     */
    private static array $provinceZoneMap = [
        // MM
        'Metro Manila' => 'MM',

        // SLZ (Southern Luzon)
        'Batangas' => 'SLZ',
        'Cavite' => 'SLZ',
        'Laguna' => 'SLZ',
        'Quezon' => 'SLZ',
        'Rizal' => 'SLZ',

        // NLZ (Northern Luzon)
        'Bulacan' => 'NLZ',
        'Pampanga' => 'NLZ',
        'Tarlac' => 'NLZ',
        'Nueva Ecija' => 'NLZ',
        'Bataan' => 'NLZ',
        'Zambales' => 'NLZ',
        'La Union' => 'NLZ',
        'Ilocos Norte' => 'NLZ',
        'Ilocos Sur' => 'NLZ',
        'Cagayan' => 'NLZ',
        'Isabela' => 'NLZ',
        'Benguet' => 'NLZ',
        'Ifugao' => 'NLZ',
        'Nueva Vizcaya' => 'NLZ',
        'Quirino' => 'NLZ',

        // VIS (Visayas)
        'Cebu' => 'VIS',
        'Iloilo' => 'VIS',
        'Bohol' => 'VIS',
        'Leyte' => 'VIS',
        'Negros Occidental' => 'VIS',
        'Negros Oriental' => 'VIS',
        'Samar' => 'VIS',
        'Eastern Samar' => 'VIS',
        'Northern Samar' => 'VIS',
        'Aklan' => 'VIS',
        'Antique' => 'VIS',
        'Capiz' => 'VIS',
        'Guimaras' => 'VIS',

        // MIN (Mindanao)
        'Davao Del Sur' => 'MIN',
        'Davao City' => 'MIN',
        'Zamboanga Del Norte' => 'MIN',
        'Zamboanga Del Sur' => 'MIN',
        'Misamis Oriental' => 'MIN',
        'Bukidnon' => 'MIN',
        'South Cotabato' => 'MIN',
        'North Cotabato' => 'MIN',
        'Agusan Del Norte' => 'MIN',
        'Agusan Del Sur' => 'MIN',
        'Surigao Del Norte' => 'MIN',
        'Surigao Del Sur' => 'MIN',
        'Lanao Del Norte' => 'MIN',
        'Lanao Del Sur' => 'MIN',
        'Sultan Kudarat' => 'MIN',
        'Maguindanao' => 'MIN',
        'Sarangani' => 'MIN',
    ];


    protected $quoteData = [];
    protected $recipient;

    public function setQuoteData(array $data, array $pickupDetails = [])
{
    $this->quoteData = $data;
    // Extract data from the NinjaVan Quote Data
    $selectedDeliveryAddress = $this->quoteData['selectedDeliveryAddress'];
    $pickupAddresses = $this->quoteData['pickupAddresses'];
    $totalWeight = $this->quoteData['total_weight'];
    $totalQty = $this->quoteData['total_qty'];
    $categories = $this->quoteData['categories'];
    $getCartItems = $this->quoteData['getCartItems'];
    $user = \App\Models\User::find($selectedDeliveryAddress['user_id']);
    $pickup = $pickupAddresses[0];
    $shop_fulladdress = $pickup['shop_fulladdress'] ?? '';
    $addressParts = explode(',', $shop_fulladdress);
    $addressParts = array_map('trim', $addressParts);
    $productIds = array_column($getCartItems, 'product_id');

    $pickupDate = $pickupDetails['pickup_date'] ?? now()->format('Y-m-d');
    $pickupStartTime = $pickupDetails['pickup_start_time'] ?? '';
    $pickupEndTime = $pickupDetails['pickup_end_time'] ?? '';
    $deliveryDate =\Carbon\Carbon::parse($pickupDate)->addDays(3)->format('Y-m-d');

    $productNames = \App\Models\Product::whereIn('id', $productIds)
        ->pluck('product_name', 'id') // [product_id => name]
        ->toArray();

    $orderedProductNames = array_map(function ($item) use ($productNames) {
        return $productNames[$item['product_id']] ?? 'Unknown Product';
    }, $getCartItems);
    $itemDescription = 'Order #' . $getCartItems[0]['id'] . ' - ' . implode(', ', $orderedProductNames);

    // Assign based on expected format:
    // 0 - address1, 1 - city, 2 - state, 3 - country, 4 - postCode
    $sender_address = [
        'address1'   => $addressParts[0] ?? '',
        'area'       => $addressParts[2] ?? '',
        'city'       => $addressParts[1] ?? '',
        'state'      => $addressParts[2] ?? '',
        'country'    => $addressParts[3] ?? '',
        'postCode'   => $addressParts[4] ?? '',
        'address2'   => '',
        'coordinates' => [
            'lat' => (string) ($pickup['lat'] ?? ''),
            'lng' => (string) ($pickup['long'] ?? ''),
        ],
    ];


    $recipientAddress = [
        'address1' => $selectedDeliveryAddress['address'],
        'address2' => '',
        'city' => $selectedDeliveryAddress['city'],
        'area' => $selectedDeliveryAddress['state'],
        'state' => $selectedDeliveryAddress['state'],
        'country' => $selectedDeliveryAddress['country'],
        'postCode' => $selectedDeliveryAddress['pincode'],
        'coordinates' => [
            'lat' => (string)$selectedDeliveryAddress['lat'],
            'lng' => (string)$selectedDeliveryAddress['lng']
        ]
    ];

    // Prepare the parcel information
    $parcelJob = [
        'is_pickup_required' => true,
        'pickup_service_type' => 'Scheduled',
        'pickup_service_level' => 'Standard',
        'pickup_date' => $pickupDate,
        'pickup_timeslot' => [
            'start_time' => $pickupStartTime,
            'end_time' => $pickupEndTime,
            'timezone' => 'Asia/Manila'
        ],
        'pickup_instructions' => 'Pickup with care!',
        'delivery_instructions' => 'Handle with care.',
        'delivery_start_date' =>\Carbon\Carbon::parse($pickupDate)->addDays(3)->format('Y-m-d'),
        'delivery_timeslot' => [
            'start_time' => '09:00',
            'end_time' => '18:00',
            'timezone' => 'Asia/Manila'
        ],
        'dimensions' => ['weight' => (float)$totalWeight],
        'items' => [
            [
                'item_description' => $itemDescription,
                'quantity' => $totalQty,
                'is_dangerous_good' => false
            ],   
        ],
    ];

    // Build the NinjaVan API payload
    $payload = [
        'marketplace' => [
            'seller_id' => $pickupAddresses[0]['vendor_id'],
            'seller_company_name' => $pickupAddresses[0]['shop_name'],
        ],
        'service_type' => 'Marketplace',
        'service_level' => 'Standard',
        'requested_tracking_number' => Str::upper(Str::random(3)) . substr(now()->timestamp, 0, 6),
        'reference' => ['merchant_order_number' => $getCartItems[0]['session_id']],
        'from' => [
            'name' => $pickupAddresses[0]['shop_name'],
            'phone_number' => $pickupAddresses[0]['shop_mobile'],
            'email' => $pickupAddresses[0]['shop_email'],
            'address' => $sender_address
        ],
        'to' => [
            'name' => $selectedDeliveryAddress['name'],
            'phone_number' => $selectedDeliveryAddress['mobile'],
            'email' => $user-> email,
            'address' => $recipientAddress
        ],
        'parcel_job' => $parcelJob,
    ];

    // Log the payload for debugging
    \Log::info("NinjaVan API Payload: " . json_encode($payload));

    return $this;
}

public function getQuotation($orderDetails, $vendor_id, $pickupDetails=[])
{
    $order = \App\Models\Order::find($orderDetails->order_id);
    $vendor = \App\Models\Vendor::with('vendorbusinessdetails')->find($vendor_id);
    $user = \App\Models\User::find($order->user_id);

    
    if (empty($vendor->vendorbusinessdetails['lat']) || empty($vendor->vendorbusinessdetails['long'])) {
        \Log::info("Vendor Business Details: " . json_encode($vendor->vendorbusinessdetails));
        return (object) ['errors' => ['message' => 'Latitude and Longitude for Vendor Business Detail is required.']];
    }

    $vendorAddress = [
        'address1' => $vendor->vendorbusinessdetails->shop_address,
        'address2' => '',
        'city' => $vendor->vendorbusinessdetails->shop_city,
        'area' => $vendor->vendorbusinessdetails->shop_state,
        'state' => $vendor->vendorbusinessdetails->shop_state,
        'country' => $vendor->vendorbusinessdetails->shop_country,
        'postCode' => $vendor->vendorbusinessdetails->shop_pincode,
        'coordinates' => [
            'lat' => (string) $vendor->vendorbusinessdetails->lat,
            'lng' => (string) $vendor->vendorbusinessdetails->long,
        ],
    ];

    $recipientAddress = [
        'address1' => $order->address,
        'address2' => '',
        'city' => $order->city,
        'area' => $order->state,
        'state' => $order->state,
        'country' => $order->country,
        'postCode' => $order->pincode,
        'coordinates' => [
            'lat' => (string) $order->lat,
            'lng' => (string) $order->lng,
        ],
    ];

    
    $pickupDate = $pickupDetails['pickup_date'] ?? now()->format('Y-m-d');
    $pickupStartTime = $pickupDetails['pickup_start_time'] ?? '';
    $pickupEndTime = $pickupDetails['pickup_end_time'] ?? '';
    $deliveryDate =\Carbon\Carbon::parse($pickupDate)->addDays(3)->format('Y-m-d');

    $quotation = [
        'marketplace' => [
            'seller_id' => $vendor->vendorbusinessdetails->vendor_id,
            'seller_company_name' => $vendor->vendorbusinessdetails->shop_name,
        ],
        'service_type' => 'Marketplace',
        'service_level' => 'Standard',
        'requestedTrackingNumber' => Str::upper(Str::random(3)) . substr(now()->timestamp, 0, 6),
        'reference' => ['merchant_order_number' => $order->id],
        'from' => [
            'name' => $vendor->vendorbusinessdetails->shop_name,
            'phone_number' => $vendor->vendorbusinessdetails->shop_mobile,
            'email' => $vendor->vendorbusinessdetails->shop_email,
            'address' => $vendorAddress,
        ],
        'to' => [
            'name' => $order->name,
            'phone_number' => $user->mobile,
            'email' => $user->email,
            'address' => $recipientAddress,
        ],
        'parcel_job' => [
            'is_pickup_required' => true,
            'pickup_service_type' => 'Scheduled',
            'pickup_service_level' => 'Standard',
            'pickup_date' => $pickupDate,
            'pickup_timeslot' => [
                'start_time' => $pickupStartTime,
                'end_time' => $pickupEndTime,
                'timezone' => 'Asia/Manila',
            ],
            'pickup_instructions' => 'Pickup with care!',
            'delivery_instructions' => 'Handle with care.',
            'delivery_start_date' => $deliveryDate,
            'delivery_timeslot' => [
                'start_time' => '09:00',
                'end_time' => '18:00',
                'timezone' => 'Asia/Manila',
            ],
            'dimensions' => ['weight' => (float) $order->total_weight],
            'items' => [[
                'item_description' => 'Order #' . $order->id,
                'quantity' => $orderDetails->product_qty,
                'is_dangerous_good' => false,
            ]],
        ],
    ];

    \Log::info('NinjaVan Quotation Payload', $quotation);

    $this->recipient = $user;
    $this->quotation = $quotation;
    $response = $this->processNinjaVan($quotation);
    $this->ninjaVanResponse = $response;

    return (object) [
        'quotation' => ['data' => ['quotation' => $quotation]],
        'response' => $response,
    ];
}



 
public function processNinjaVan($body)
{
    \Log::info("Process NinjaVan Quotation API Payload: " . json_encode($body));
    $apiUrl = config('app.ninjavan.api_url'); // e.g. https://api-sandbox.ninjavan.co/SG

    $tokenResponse = config('app.ninjavan.access_token'); // Assumes this returns an object with 'access_token'

    $endpoint = '/4.2/orders'; // Use the correct version/path as needed
    $url = rtrim($apiUrl, '/') . $endpoint;

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HEADER => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer ' . $tokenResponse,
        ],
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    \Log::info("Process NinjaVan Quotation Response". $response);

    return json_decode($response);
}

public function getAccessToken()
    {
    $clientId = config('app.ninjavan.client_id');
    $clientSecret = config('app.ninjavan.client_key');
    $url = config('app.ninjavan.api_url'). '/2.0/oauth/access_token';

    $body = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'grant_type' => 'client_credentials',
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($body),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/x-www-form-urlencoded',
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    \Log::info("NinjaVan Token Response: " . $response);
    return json_decode($response);
    }
}
