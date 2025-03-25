{{-- This page is rendered by termsAndConditions() method in Front/IndexController.php --}}
@extends('front.layout.layout')
<style>
    .careers_outer_wrapper{
        background: #F1F5F0;
    }
    .careers_outer_wrapper .full_height_width{
        min-height: 60vh;
        min-width: 100%;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .careers_outer_wrapper .econinner{
        max-width: 1440px;
        margin-left: auto;
        margin-right: auto;
    }
    .careers_outer_wrapper h1{
        color: #87cbb9;
        font-size: 70px;
    }
    @media (max-width: 749px){
        .careers_outer_wrapper h1{
            font-size: 50px;
        } 
        .careers_outer_wrapper .full_height_width{
            min-height: 55vh;
        }
    }
</style>

@section('content')

<div class="careers_outer_wrapper">
    <div class="elementor-element">
        <div class="econinner">
            <div class="full_height_width">
                <h1>COMING SOON...</h1>
            </div>
        </div>
    </div>
</div>

@endsection