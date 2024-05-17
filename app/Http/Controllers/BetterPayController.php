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

    public function processPayment()
    {
        $merchant_id = "10417";
        $api = "X0zaxqVmp0Op";
        $invoice = "INV0002";
        $amount = "203.10";
        $payment_desc = "Payment description";
        $currency = "PHP";
        $buyer_name = "Juan Dela Cruz";
        $callback_url_be = "http://localhost:8000/better-pay/result";
        $url = "https://www.demo.betterpay.me/merchant/api/v2/receiver";

        $data = $this->formatWithPipes([
            'api' => $api,
            'merchant_id' => $merchant_id,
            'invoice' => $invoice,
            'amount' => $amount,
            'payment_desc' => $payment_desc,
            'currency' => $currency,
        ]);

        $response = Http::asForm()->post($url, [
            '_token' => csrf_token(),
            ...$data['items'],
            'buyer_name' => $buyer_name,
            'callback_url_be' => $callback_url_be,
            'hash' => $data['hashed_string'],
        ]);

        dd($response);
    }

    public function createCollectionPayment()
    {
        $merchant_id = "10417";
        $api = "X0zaxqVmp0Op";
        $purpose = "Standard Payment copy";
        $amount_option = "Fixed";
        $amount = "153.20";
        $delivery_option = 0;
        $currency = "PHP";
        $url = 'https://www.demo.betterpay.me/merchant/api/v2/link/create';

        $data = $this->formatWithPipes([
            'api' => $api,
            'merchant_id' => $merchant_id,
            'purpose' => $purpose,
            'amount_option' => $amount_option,
            'amount' => $amount,
            'delivery_option' => $delivery_option,
            'currency' => $currency,
        ]);

        $response = Http::asForm()->post($url, [
            '_token' => csrf_token(),
            ...$data['items'],
            'hash' => $data['hashed_string'],
        ]);

        // dd($response);
        return redirect()->route('better-pay.index');
    }

    private function formatWithPipes(array $items): array
    {
        // Use array_filter to remove any empty items if necessary
        $filteredItems = array_filter($items, function ($item) {
            return trim($item) !== '';
        });

        // Join the items with ' | ' as the separator
        $formattedString = implode('|', $filteredItems);

        return [
            'items' => $filteredItems,
            'formatted_string' => $formattedString,
            'hashed_string' => md5($formattedString),
        ];
    }
}
