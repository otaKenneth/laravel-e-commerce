<?php

namespace App\Http\Controllers;

use App\Http\Requests\BetterPay\StandardPaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class BetterPayController extends Controller
{
    public function index()
    {
        return view('better-pay');
    }

    public function sendPaymentRequest()
    {
        $merchant_id = "10417";
        $api = "X0zaxqVmp0Op";
        $invoice = "INV000999";
        $amount = "203.10";
        $payment_desc = "Payment description";
        $currency = "PHP";
        $buyer_name = "Juan Dela Cruz";
        $buyer_email = "roeiboribor.metacombpo@gmail.com";
        $phone = "9976680777";
        $callback_url_be = "http://localhost:8000/better-pay/result";
        $url = "https://www.demo.betterpay.me/merchant/api/v2/receiver";

        $values = $this->formatWithPipes([
            'merchant_id' => $merchant_id,
            'invoice' => $invoice,
            'amount' => $amount,
            'payment_desc' => $payment_desc,
            'currency' => $currency,
            'buyer_name' => $buyer_name,
            'buyer_email' => $buyer_email,
            'phone' => $phone,
            'callback_url_be' => $callback_url_be,
        ]);

        $response = Http::asForm()->post($url, [
            ...$values['items'],
            'hash' => $values['hashed_string'],
        ]);

        if ($response->successful()) {
            $data = $response->json();
            dd($data);
        } else {
            dd('Error: ' . $response->status());
        }

        dd($response);
    }

    public function createCollectionPayment()
    {
        $merchant_id = '10417';
        $purpose = 'Invoice for Sheila';
        $amount_option = 'Fixed';
        $amount = '150.50';
        $delivery_option = 0;
        $currency = 'PHP';
        $url = 'https://www.demo.betterpay.me/merchant/api/v2/lite/link/create';

        $values = $this->formatWithPipes([
            'merchant_id' => $merchant_id,
            'purpose' => $purpose,
            'amount_option' => $amount_option,
            'amount' => $amount,
            'delivery_option' => $delivery_option,
            'currency' => $currency,
        ]);

        $response = Http::asForm()->post($url, [
            ...$values['items'],
            'hash' => $values['hashed_string'],
        ]);

        if ($response->successful()) {
            $data = $response->json();
            dd($data);
        } else {
            dd('Error: ' . $response->status());
        }

        return redirect()->route('better-pay.index');
    }

    public function listCollectionPayments()
    {
        $merchant_id = '10417';
        $url = 'https://www.demo.betterpay.me/merchant/api/v2/lite/link/list';

        $values = $this->formatWithPipes([
            'merchant_id' => $merchant_id,
        ]);

        $response = Http::post($url, [
            ...$values['items'],
            'hash' => $values['hashed_string'],
        ]);

        if ($response->successful()) {
            $data = $response->json();
            dd($data);
        } else {
            dd('Error: ' . $response->status());
        }

        return redirect()->route('better-pay.index');
    }

    private function formatWithPipes(array $items): array
    {
        // Use array_filter to remove any empty items if necessary
        $filteredItems = array_filter($items, function ($item) {
            return trim($item) !== '';
        });

        // BETTER PAY API REQUEST PROCESS
        ksort($filteredItems);
        // Concatenate and Remove Spaces
        $formattedString = preg_replace('/\s+/', '', implode('', $filteredItems));

        return [
            'items' => $filteredItems,
            'formatted_string' => $formattedString,
            'hashed_string' => hash_hmac('sha256', $formattedString, "X0zaxqVmp0Op"), // API_KEY
        ];
    }
}
