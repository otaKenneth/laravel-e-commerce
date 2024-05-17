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
        $purpose = "Standard Paymentsss";
        $amount_option = "Fixed";
        $amount = "203.10";
        $delivery_option = 0;
        $currency = "PHP";
        // $url = "https://www.demo.betterpay.me/merchant/api/v2/receiver";
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
            // '_token' => csrf_token(),
            ...$data['items'],
            'hash' => $data['hashed_string'],
        ]);

        dd($response);
    }

    public function createCollectionPayment()
    {
        $merchant_id = "10417";
        $api = "X0zaxqVmp0Op";
        $purpose = "Advance Payment";
        $amount_option = "Fixed";
        $amount = "153.20";
        $delivery_option = 0;
        $currency = "PHP";
        $url = 'https://www.demo.betterpay.me/merchant/api/v2/link/create';

        // $api . "|" . 
        $for_hashing = $api . "|" . $merchant_id . "|" . $purpose . "|" . $amount_option . "|" . $amount . "|" . $delivery_option . "|" . $currency;
        $hashed_string = md5($for_hashing);
        // $hashed_string = md5($api . "|" . urldecode($merchant_id) . "|" . urldecode($request->invoice) . "|" . urldecode($request->amount) . "|" . urldecode($request->payment_desc));

        $response = Http::asForm()->post($url, [
            'merchant_id' => $merchant_id,
            'purpose' => $purpose,
            'amount_option' => $amount_option,
            'amount' => $amount,
            'delivery_option' => $delivery_option,
            'currency' => $currency,
            'hash' => $hashed_string,
        ]);

        dd($response);
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
