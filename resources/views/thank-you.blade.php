@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <img src="{{asset('img/wines-header.jpg')}}">
            <h1>Thank you for placing an order!</h1>
        </div>
        <p style="margin-bottom: 30px;">
            Order Number: {{ $order }} has been sent to the winery, please expect it within 5-7 days.
        </p>
    </div>
@endsection