@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <img src="{{asset('img/wines-header.jpg')}}">
            <h1>Thank you for placing an order!</h1>
        </div>
        <p style="margin-bottom: 30px;">
            Order Number: {{ $order->order_id }} has been sent to the winery, please expect it within {{ $from_to->days_from }} - {{ $from_to->days_to }} days.
        </p>
    </div>
@endsection