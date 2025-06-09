<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NinjaVanAPIHelper
{
    /**
     * Get the access token for Ninja Van API.
     *
     * @return string
     * @throws \Exception
     */

protected function getAccessToken(){return config('ninjavan.access_token');}
public function trackShipment($trackingNumber)
{
    $token = config('ninjavan.access_token');
    $url = config('ninjavan.api_url') . '/' . config('ninjavan.region') . '/4.2/track';

    $response = Http::withToken($token)
        ->get($url, ['tracking_number' => $trackingNumber]);

    if (!$response->successful()) {
        throw new \Exception('Tracking failed: ' . $response->body());
    }

    return $response->json();
}

}

?>