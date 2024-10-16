<?php

namespace App\Helpers;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Log;

class PaymongoAPIHelper 
{
    private $cancel_url;

    private $billing = [
        "address" => [
            "line1" => "",
            "line2" => "",
            "city" => "",
            "state" => "",
            "postal_code" => "",
            "country" => "",
        ],
        "name" => "",
        "email" => "",
        "phone" => ""
    ];

    private $description = "";

    private $line_items = [];

    // possible values
    // billease, card, dob, dob_ubp, brankas_bdo, brankas_landbank, brankas_metrobank, gcash, grab_pay
    private $payment_method_types = "";

    private $reference_number;

    private $send_email_receipt = true;

    private $show_description = true;

    private $show_line_items = false;
    
    private $success_url;

    private $statement_descriptor;

    private $session;

    public function __construct()
    {
        $this->cancel_url = url('/checkout');
        $this->success_url = url('/thanks');
        $this->reference_number = md5(Carbon::now());
        $this->statement_descriptor = env("APP_NAME") . " - " . env("APP_ENV");
    }

    public function set($key, $value) {
        $this->$key = $value;
        return $this;
    }

    public function get($key) {
        if (!isset($this->$key)) return false;
        return $this->$key;
    }

    public function setItems($cart_items) {
        $total_amount = 0;
        foreach ($cart_items as $key => $cart_item) {
            $item_description = "Kapiton Store: ";
            $item_description .= $cart_item['product']['product_name'] . ", " . $cart_item['color'] . ", " . $cart_item['size'] . ".";

            $prod_price = $cart_item['product']['product_price'];
            $amount = number_format($prod_price * 100, 0, '.', '');
            $total_amount += $amount;
            Log::info("Paymongo: setItems - " . $amount);
            
            $line_item = [
                'amount' => (int) $amount,
                'currency' => "PHP",
                'description' => $item_description,
                'name' => $cart_item['product']['product_name'],
                'quantity' => $cart_item['quantity']
            ];
            array_push($this->line_items, $line_item);
        }

        return $this;
    }

    public function setDeliveryFee($delivery_fee) {
        $amount = round($delivery_fee * 100, 0);
        Log::info("Paymongo: setItems - " . $amount);

        $delivery = [
            'amount' => (int) $amount,
            'currency' => "PHP",
            'description' => "Kapiton Store x Lalamove - Delivery Fee",
            'name' => "Delivery Fee",
            'quantity' => 1
        ];

        array_push($this->line_items, $delivery);

        return $this;
    }

    public function computeTransactionFee() {
        $total_amount = array_sum(array_map(function ($a) {
            return $a['amount'];
        }, $this->line_items));
        
        // transaction fee
        $a_amount = $total_amount * 0.05;
        $b_amount = $a_amount * 0.04;
        $amount = round($a_amount + $b_amount, 0);
        $line_item = [
            'amount' => (int) $amount,
            'currency' => "PHP",
            'description' => "Paymongo - Transaction Fee",
            'name' => "Transaction Fee",
            'quantity' => 1
        ];
        array_push($this->line_items, $line_item);
        return $this;
    }

    public function createSession() {
        $client = new Client();

        $self = get_object_vars($this);
        // dd($self);
        $data = json_encode(["data" => ["attributes" => $self]]);
        $secret = config('services.paymongo.secret');
        $encrypt = base64_encode($secret);

        try {
            // dd($data);
            Log::info("Paymongo: Create Session - " . $data);
            $response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
                'body' => $data,
                'headers' => [
                    'Content-Type' => "application/json",
                    'accept' => "application/json",
                    'authorization' => "Basic {$encrypt}" 
                ]
            ]);

            // dd($response);
            $responseBody = $response->getBody()->getContents();

            // Check if JSON decoding was successful
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Failed to decode JSON response: ' . json_last_error_msg());
            }

            // Use the payload as needed
            $this->session = json_decode($responseBody)->data->attributes;
            Log::info("Paymongo: Create Session Payload - " . $responseBody);

            return [
                'success' => true,
                'message' => "Paymongo checkout url successfully retrieved.",
                'data' => [
                    'redirect' => false,
                    'open' => true,
                    'url' => $this->session->checkout_url,
                    'reference_number' => $this->session->payment_intent->id,
                ]
            ];
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle Guzzle request exception
            return [
                'success' => false,
                'message' => 'Request failed: ' . $e->getMessage()
            ];
        } catch (Exception $e) {
            // Handle other exceptions
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    public function parseSignatureHeader($header)
    {
        $parts = explode(',', $header);
        $signatures = [];

        foreach ($parts as $part) {
            [$key, $value] = explode('=', $part);
            $signatures[trim($key)] = trim($value);
        }

        return $signatures;
    }

    public function verifySignature($expectedSignature, $payload, $timestamp)
    {
        $secret = config('services.paymongo.webhook_secret'); // Your PayMongo secret
        $payloadToSign = $timestamp . '.' . $payload;

        $computedSignature = hash_hmac('sha256', $payloadToSign, $secret);

        return hash_equals($expectedSignature, $computedSignature);
    }
}
