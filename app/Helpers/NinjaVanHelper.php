<?php

namespace App\Helpers;

class NinjaVanHelper
{
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
            'name' => $vendor->vendorbusinessdetails->shop_name,
            'address' => $vendor->vendorbusinessdetails->shop_address,
            'city' => $vendor->vendorbusinessdetails->shop_city,
            'province' => $vendor->vendorbusinessdetails->shop_state,
            'country' => $vendor->vendorbusinessdetails->country,
            'postalCode' => $vendor->vendorbusinessdetails->shop_pincode,
            'lat' => (string) $vendor->vendorbusinessdetails['lat'],
            'lng' => (string) $vendor->vendorbusinessdetails['long'],
        ];

        $recipient_address = [
            'name' => $order->name ?? '',
            'address' => $order->address,
            'city' => $order->city,
            'province' => $order->state,
            'country' => $order->country,
            'postalCode' => $order->pincode,
            'lat' => (string) $order->lat,
            'lng' => (string) $order->lng,
        ];

        // Calculate shipping charge using NinjaVanHelper
        $shipping_charge = self::calculateShippingCharge(
            (float) $order->total_weight,
            $order->state
        );

        // Prepare quotation response (simulate NinjaVan API response)
        $quotation = [
            'shipping_charge' => $shipping_charge,
            'currency' => 'PHP',
            'sender' => $sender_address,
            'recipient' => $recipient_address,
            'weight_kg' => (float) $order->total_weight,
            'zone' => self::getZoneFromProvince($order->state),
        ];

        \Log::info("NinjaVan Quotation: " . json_encode($quotation));

        return (object) [
            'quotation' => $quotation
        ];
    }
    
}
