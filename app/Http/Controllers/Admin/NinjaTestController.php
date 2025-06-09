<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\NinjavanAPIHelper as NinjavanService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class NinjaTestController extends Controller
{
     public function testToken(NinjavanService $ninjavan)
    {
        $token = config('ninjavan.access_token');   
        return response()->json(['token' => $token]);
    }
    public function testShipment()
{
    $payload = [
        "marketplace" => [
            "seller_id" => "John-Doe-Shop",
            "seller_company_name" => "John Doe Shop"
        ],
        "service_type" => "Marketplace",
        "service_level" => "Standard",
        "requested_tracking_number" => "ABC123456",
        "reference" => [
            "merchant_order_number" => "SHIP-1234-56789"
        ],
        "from" => [
            "name" => "John Doe",
            "phone_number" => "+60138201527",
            "email" => "john.doe@gmail.com",
            "address" => [
                "address1" => "17 Lorong Jambu 3",
                "address2" => "",
                "area" => "Taman Sri Delima",
                "city" => "Simpang Ampat",
                "state" => "Pulau Pinang",
                "address_type" => "office",
                "country" => "MY",
                "postcode" => "51200"
            ]
        ],
        "to" => [
            "name" => "Jane Doe",
            "phone_number" => "+60103067174",
            "email" => "jane.doe@gmail.com",
            "address" => [
                "address1" => "Jalan PJU 8/8",
                "address2" => "",
                "area" => "Damansara Perdana",
                "city" => "Petaling Jaya",
                "state" => "Selangor",
                "address_type" => "home",
                "country" => "MY",
                "postcode" => "47820"
            ]
        ],
        "parcel_job" => [
            "is_pickup_required" => true,
            "pickup_service_type" => "Scheduled",
            "pickup_service_level" => "Standard",
            "pickup_date" => "2025-06-10", // ✅ make sure this is not in the past
            "pickup_timeslot" => [
                "start_time" => "09:00",
                "end_time" => "12:00",
                "timezone" => "Asia/Kuala_Lumpur"
            ],
            "pickup_instructions" => "Pickup with care!",
            "delivery_instructions" => "If recipient is not around, leave parcel in power riser.",
            "delivery_start_date" => "2025-06-11",
            "delivery_timeslot" => [
                "start_time" => "09:00",
                "end_time" => "12:00",
                "timezone" => "Asia/Kuala_Lumpur"
            ],
            "dimensions" => [
                "weight" => 1.5
            ],
            "items" => [
                [
                    "item_description" => "Sample product",
                    "quantity" => 1,
                    "is_dangerous_good" => false
                ]
            ]
        ]
    ];

    try {
        $response = $this->createShipment($payload);
        return response()->json($response);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function createShipment(array $payload)
    {
        $token = config('ninjavan.access_token');   

        $url = config('ninjavan.api_url') . '/' . '/4.2/orders';

        $response = Http::withToken($token)
            ->post($url, $payload);

        if (!$response->successful()) {
            throw new \Exception('Failed to create shipment: ' . $response->body());
        }

        return $response->json();
    }
  public function trackShipment(Request $request)
{
    $trackingNumber = $request->query('tracking_number');
    $token = config('ninjavan.access_token');
    $url = config('ninjavan.api_url') . '/4.2/track';

    $response = Http::withToken($token)->get($url, [
        'tracking_number' => $trackingNumber,
    ]);

    if (!$response->successful()) {
        return response()->json(['error' => 'Failed to fetch tracking status'], 500);
    }

    $data = $response->json();
    return response()->json([
        'tracking_number' => $trackingNumber,
        'order_status' => $data['order_status'] ?? 'Unknown',
        'raw' => $data // Optional: For debugging
    ]);
}

}


