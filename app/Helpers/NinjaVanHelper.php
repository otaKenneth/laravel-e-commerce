<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class NinjaVanHelper
{
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
    return self::calculateShippingCharge($weightKg, $address['state'] ?? '');
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

    public function getQuotation($orderDetails, $vendor_id)
    {
        $order = \App\Models\Order::find($orderDetails->order_id);
        $user_model = new \App\Models\User;
        $vendor_model = new \App\Models\Vendor;

        // Get vendor details
        $vendor = $vendor_model->with('vendorbusinessdetails')->find($vendor_id);

        if (empty($vendor->vendorbusinessdetails['lat']) || empty($vendor->vendorbusinessdetails['long'])) {
            \Log::info("Vendor Business Details: " . json_encode($vendor->vendorbusinessdetails));
            return (object) [
                'errors' => [
                    'message' => "Latitude and Longitude for Vendor Business Detail is required."
                ],
            ];
        }

        // Prepare sender and recipient addresses
        $sender_address = [
            'address1' => $vendor->vendorbusinessdetails->shop_address,
            'address2' => '',
            'city' => $vendor->vendorbusinessdetails->shop_city,
            'area' => $vendor->vendorbusinessdetails->shop_state,
            'state' => $vendor->vendorbusinessdetails->shop_state,
            'country' => $vendor->vendorbusinessdetails->country,
            'postCode' => $vendor->vendorbusinessdetails->shop_pincode,
        ];

        $recipient_address = [
            'address1' => $user_model->find($order->user_id)->address,
            'address2' => '',
            'city' => $user_model->find($order->user_id)->city,
            'area' =>$user_model->find($order->user_id)->state,
            'state' =>$user_model->find($order->user_id)->state,
            'country' => $user_model->find($order->user_id)->country,
            'postCode' => $user_model->find($order->user_id)->pincode,
        ];

        $parcel_job = [
            "is_pickup_required"=> true,
            "pickup_service_type"=>"Scheduled",
            "pickup_service_level"=>"Standard",
            "pickup_date"=> now()->timestamp,
            "pickup_timeslot"=> [
                "start_time"=>"09:00",
                "end_time"=> "12:00",
                "timezone"=> "Asia/Manila"
            ],
            "pickup_instructions"=> "Pickup with care!",
            "delivery_instructions"=> "If recipient is not around, leave parcel in power riser.",
            "delivery_start_date"=> now()->addDays(3)->timestamp,
            "delivery_timeslot"=> [
                "start_time"=>"09:00",
                "end_time"=> "12:00",
                "timezone"=> "Asia/Manila"
            ],
            "dimensions"=>['weight'=> (float) $order->total_weight],
            "items"=> [ 
                    "item_description" => "Order #" . $orderDetails->orderId . " - " . $order->order_items()->pluck('product_name')->implode(', '),
                    "quantity" => $orderDetails->total_qty,
                    "is_dangerous_good" => false,
            ],
        ];
        // Calculate shipping charge using NinjaVanHelper
        $shipping_charge = self::calculateShippingCharge(
            (float) $order->total_weight,
            $order->state
        );

        // Prepare quotation response (simulate NinjaVan API response)
        $quotation = [
            'marketplace' => [
                'seller_id' => $vendor->vendorbusinessdetails->vendor_id,
                'seller_company_name' => $vendor->vendorbusinessdetails->shop_name,
            ],
            'service_type' => 'Marketplace',
            'service_level' => $orderDetails->service_level ?? 'Standard',
            'requestedTrackingNumber' => 'TEST-' . now()->timestamp,
            'reference'=> ['merchant_order_number' => $orderDetails->orderId],
            'from' => [
                'name' => $vendor->vendorbusinessdetails->shop_name,
                'phone_number' => $vendor->vendorbusinessdetails->shop_mobile,
                'email' => $vendor->vendorbusinessdetails->shop_email,
                'address'=>$sender_address,
            ], 
            'to' => [
                'name' => $user_model->find($order->user_id)->name,
                'phone_number' => $user_model->find($order->user_id)->mobile,
                'email' => $user_model->find($order->user_id)->email,
                'address'=>$recipient_address,
            ],
            'parcel' => $parcel_job,
            'weight_kg' => (float) $order->total_weight,
            'zone' => self::getZoneFromProvince($order->state),
        ];

        \Log::info("NinjaVan Quotation: " . json_encode($quotation));
        $this->recipient = $user_model->find($order->user_id);
        return (object) [
            'quotation' => $quotation
        ];
    }
 
    public function processNinjavanQuotation(array $body)
{
    $clientId = config('app.ninjavan.client_id');
    $clientSecret = config('app.ninjavan.client_secret');
    $apiUrl = config('app.ninjavan.api_url');

    // Step 1: Get Bearer Token
    $tokenResponse = $this->getAccessToken(); // Assume this returns access_token as string
    if (!$tokenResponse || empty($tokenResponse->access_token)) {
        \Log::error("Failed to get NinjaVan access token.");
        return (object) ['errors' => ['message' => 'Access token error']];
    }

    $accessToken = $tokenResponse->access_token;

    // Step 2: Make quotation request
    $endpoint = '/orders/quotation'; // Use correct path based on API version
    $url = rtrim($apiUrl, '/') . $endpoint;

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
            'Accept: application/json',
        ],
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    \Log::info("NinjaVan Quotation Response ($httpCode): $response");

    return json_decode($response);
}

    
//     public function createOrder(){
//     $url = config('services.ninjavan.api_url') . "/4.2/orders";
//     $accessToken = config('services.ninjavan.access_token');

//     $payload = [
//         "reference" => [
//             "merchant_order_number" => "TESTORDER-" . now()->timestamp
//         ],
//         "marketplace" => [
//         "seller_id" => "Kapiton-Marketplace",
//         "seller_company_name"=> "John Doe Shop"
//     ],
//         "service_type" => "Marketplace",
//         "service_level" => "Standard", // ✅ Should be a string
//         "requested_tracking_number" => "TEST1234",
//         "from" => [
//             "name" => "Cellphone Range IU",
//             "phone_number" => "09653265656",
//             "email" => "support@cellphonesrange.com.ph",
//             "address" => [
//                 "address1" => "#12 Test Address",
//                 "city" => "Mandaluyong City",
//                 "state" => "Metro Manila",
//                 "country" => "PH",
//                 "postcode" => "1500"
//             ]
//         ],
//         "to" => [
//             "name" => "Adrian Nebasa",
//             "phone_number" => "+639452073341",
//             "email" => "adrian@example.com",
//             "address" => [
//                 "address1" => "Sunshine City Plaza 100",
//                 "city" => "Mandaluyong City",
//                 "state" => "Metro Manila",
//                 "country" => "PH",
//                 "postcode" => "1500"
//             ]
//         ],
//         "parcel_job" => [
//             "pickup_date" => "2025-06-18",
//             "pickup_timeslot" => [
//                 "start_time" => "09:00",
//                 "end_time" => "12:00",
//                 "timezone" => "Asia/Manila"
//             ],
//             "delivery_start_date" => "2025-06-19",
//             "delivery_timeslot" => [
//                 "start_time" => "15:00",
//                 "end_time" => "18:00",
//                 "timezone" => "Asia/Manila"
//             ],
//             "dimensions" => [
//                 "weight" => 1
//             ],
//             "items" => [
//                 [
//                     "item_description" => "Smartphone 11",
//                     "quantity" => 1,
//                     "is_dangerous_good" => false
//                 ]
//             ]
//         ]
//     ];
//        try {
//     // Load config values
//     $ninjavanConfig = config('app.ninjavan');

//     $accessToken = $ninjavanConfig['access_token'];
//     $baseUrl = rtrim($ninjavanConfig['api_url'], '/'); // Ensure no trailing slash
//     $orderUrl = $baseUrl . '/4.2/orders';

//     // Send the request to NinjaVan
//     $response = Http::withToken($accessToken)
//         ->timeout(15)
//         ->post($orderUrl, $payload);

//     // Check response
//     if ($response->successful()) {
//         $responseData = $response->json();
//         Log::info("NinjaVan Test Order Created", $responseData);
//         return $responseData;
//     } else {
//         Log::warning("NinjaVan responded with error", ['status' => $response->status(), 'body' => $response->body()]);
//         return ['error' => $response->body()];
//     }

// } catch (\Exception $e) {
//     Log::error("NinjaVan Order Creation Failed", ['error' => $e->getMessage()]);
//     return ['error' => $e->getMessage()];
// }
// }

public function getAccessToken()
    {
    $clientId = config('app.ninjavan.client_id');
    $clientSecret = config('app.ninjavan.client_key');
    $url = config('app.ninjavan.api_url'). '/2.0/oauth/access_token'; // e.g. https://api-sandbox.ninjavan.co/2.0/oauth/token

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