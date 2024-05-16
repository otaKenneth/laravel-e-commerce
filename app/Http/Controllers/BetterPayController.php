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

    public function processPayment(StandardPaymentRequest $request)
    {
        $validated = $request->validated();

        $merchant_id = "10417";
        $api = "X0zaxqVmp0Op";
        // $merchant_id = intval(config('better-pay.merchant_id'));
        // $api = config('better-pay.api_key');

        $for_hashing = $api . "|" . $merchant_id . "|" . $request->invoice . "|" . $request->amount . "|" . $request->payment_desc;
        // $hashed_string = md5($for_hashing);
        $hashed_string = md5($api . "|" . urldecode($merchant_id) . "|" . urldecode($request->invoice) . "|" . urldecode($request->amount) . "|" . urldecode($request->payment_desc));

        // $betterpay_link_sandbox = config('better-pay.sandbox_url');
        $betterpay_link_sandbox = "https://www.demo.betterpay.me/merchant/api/v2/receiver";

        // dd([
        //     'merchant_id' => $merchant_id,
        //     ...$validated,
        //     'currency' => "PHP",
        //     'hash' => $hashed_string,
        // ]);

        $response = Http::post($betterpay_link_sandbox, [
            'merchant_id' => $merchant_id,
            ...$validated,
            'currency' => "PHP",
            'hash' => $hashed_string,
        ]);

        dd($response);
    }
}
