<?php

namespace App\Helpers;
use Exception;
use GuzzleHttp\Client;
use Log;

class PaymongoRefundAPIHelper
{
    private $amount;

    private $notes;

    private $payment_id;

    private $reason;

    private $session;

    public function setAmount() {
        $amount = round($this->amount, 2);
        $amount = $amount * 100;

        $this->amount = (int) $amount;

        return $this;
    }

    public function set($key, $value) {
        $this->$key = $value;
        return $this;
    }

    public function get($key) {
        if (!isset($this->$key)) return false;
        return $this->$key;
    }

    public function createRefund() {
        $client = new Client();

        $self = get_object_vars($this);
        // dd($self);
        $data = json_encode(["data" => ["attributes" => $self]]);
        $secret = config('services.paymongo.secret');
        $encrypt = base64_encode($secret);

        try {
            // dd($data);
            Log::info("Paymongo: Create Refund - " . $data);
            $response = $client->request('POST', 'https://api.paymongo.com/refunds', [
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
            $this->session = json_decode($responseBody)->data;

            return [
                'success' => true,
                'message' => "Paymongo refund session successfully retrieved.",
                'data' => [
                    'redirect' => false,
                    'open' => true,
                    'reference_number' => $this->session->id,
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
}
