{{-- This page is accessed from Becoma a Merchant section in footer Learn more button --}} 
@extends('front.layout.layout')

@section('content')

<style>
    .email-confirmed-outer{
        min-height: 600px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f1f5f0;
        gap: 30px;
        padding: 20px;
        flex-direction: column;
    }
    .email-confirmed-outer p{
        font-size: 20px;
        max-width: 480px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    @media (max-width: 767px){
        .email-confirmed-outer{
            min-height: 480px;
            gap: 10px;
        }
        dotlottie-player{
            width: 210px !important;
            height: 210px !important;
        }
        .email-confirmed-outer p{
            font-size: 18px;
        }
    }
</style>
<div class="email-confirmed-outer">

<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

    <dotlottie-player src="https://lottie.host/5f89c8da-76a0-4d9f-9ba4-a5036d87dc6e/B8p2xpxyYp.json" background="transparent" speed="1" style="width: 250px; height: 250px;" loop autoplay></dotlottie-player>

    @if (session('error_message'))
        <p><b>{{session('error_message')}}</b></p>
    @elseif ($error_message)
        <p><b>{{$error_message}}</b></p>
    @endif


</div>





@endsection