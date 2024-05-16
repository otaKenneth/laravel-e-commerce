<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BetterPayController extends Controller
{
    public function index()
    {
        return view('better-pay');
    }

    public function store(Request $request)
    {
        $merchant_id = intval(config('better-pay.merchant_id'));
        $api = config('better-pay.api_key');

        $hashed_string = md5($api . "|" . urldecode($merchant_id) . "|" . urldecode($request->invoice) . "|" . urldecode($request->amount) . "|" . urldecode($request->payment_desc));

        $betterpay_link_sandbox = config('better-pay.sandbox_url');

        $response = Http::asForm()->post($betterpay_link_sandbox, [
            'merchant_id' => $merchant_id,
            'invoice' => $request->invoice,
            'amount' => $request->amount,
            'payment_desc' => $request->payment_desc,
            'currency' => "PHP",
            'hash' => $hashed_string
        ]);

        dd($response);
    }
}
