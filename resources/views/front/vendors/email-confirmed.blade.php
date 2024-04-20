{{-- This page is accessed from Becoma a Merchant section in footer Learn more button --}} 
@extends('front.layout.layout')

@section('content')
@if (session('error_message'))
    <strong>{{session('error_message')}}</strong>
@elseif ($error_message)
    <strong>{{$error_message}}</strong>
@endif
@endsection