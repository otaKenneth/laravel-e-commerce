{{-- This page is rendered by orders() method inside Admin/OrderController.php --}}
@extends('admin.layout.layout')

@section('content')
<div>
    @foreach ($pcontents as $content)
    <form id="form-platform-content-{{$content->container}}">
        <h4>{{$content->container}}</h4>
        <textarea rows="" cols="">{{$content->content}}</textarea>
        <button type="submit">Save</button>
    </form>
    @endforeach
</div>
@endsection
