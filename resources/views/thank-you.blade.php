@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0">
    	<div class="page-header">
            <img src="{{asset('img/wines-header.jpg')}}">
            <h1>Thank you for placing an order!</h1>
        </div>
    </div>
    <div class="container d-flex justify-content-center">

        <p class="text-center" style="margin-bottom: 30px;">
            Order Number:<b class="mx-2">{{ $order->order_id }}</b>  has been sent to the winery.
        </p>
    </div>
@endsection
