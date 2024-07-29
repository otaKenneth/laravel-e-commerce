{{-- This page is rendered by the thanks() method inside Front/ProductsController.php --}}
@extends('front.layout.layout')


@section('content')
    <!-- Cart-Page -->
    <div class="page-cart thank-you-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" align="center">
                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
                    <dotlottie-player src="https://lottie.host/0ff4511f-e778-4a9d-9a0f-ca27acf524a0/LYUGVGP11d.json" background="transparent" speed="1" loop autoplay></dotlottie-player>
                    <h3>YOUR ORDER HAS BEEN PLACED SUCCESSFULLY</h3>
                    <p>Your order number is {{ Session::get('order_id') }} and Grand Total is PHP {{ Session::get('grand_total') }}</p> {{-- The Order Number is the order `id` in the `orders` database table. We stored the order id in Session in checkout() method in Front/ProductsController.php --}} {{-- Retrieving Data: https://laravel.com/docs/10.x/session#retrieving-data --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
@endsection



{{-- Forget/Remove some data in the Session after making/placing the order --}} 
@php
    use Illuminate\Support\Facades\Session;

    Session::forget('grand_total');  // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
    Session::forget('order_id');     // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
    Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
    Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
@endphp