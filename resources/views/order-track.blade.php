@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row">
        <h1 class="headline-2">TRACK YOUR ORDER</h1>
    </div>

    <div class="row padding-row tracking">
        <div class="col-lg-12 col-sm-12 col-xs-12 order-info">
            <p><span>Estimated delivery time: </span>Aug 04 - Aug 14</p>
            <p><span>Order ID: </span>00012345678910</p>
            <p><span>Carrier: </span>FedEx</p>
        </div>
        <div class="col-lg-12 col-sm-12 col-xs-12 tracking-slider">
            <img src="{{asset('img/tracking-slider.png')}}">
            <span class="float-left">
                <p>Shipment accepted</p>
                <p>Aug 04</p>
            </span>
            <span class="float-right">
                <p>Shipment accepted</p>
                <p>Aug 04</p>
            </span>
        </div>
        <div class="col-lg-6 col-sm-12 ship-to">
            <p><span>Ship to: </span><i>(Address)</i></p>
            <p>Jane Doe</p>
            <p>321 Place for Street</p>
            <p>Name of the City, XY12345</p>
            <p>State</p>
            <p>Phone Number</p>
        </div>
    </div>

    <div class="row padding-row tracking">
        <div class="col-lg-12 col-sm-12 col-xs-12 order-info">
            <p><span>Estimated delivery time: </span>Aug 04 - Aug 14</p>
            <p><span>Order ID: </span>00012345678910</p>
            <p><span>Carrier: </span>FedEx</p>
        </div>
        <div class="col-lg-12 col-sm-12 col-xs-12 tracking-slider">
            <img src="{{asset('img/tracking-slider.png')}}">
            <span class="float-left">
                <p>Shipment accepted</p>
                <p>Aug 04</p>
            </span>
            <span class="float-right">
                <p>Shipment accepted</p>
                <p>Aug 04</p>
            </span>
        </div>
        <div class="col-lg-6 col-sm-12 ship-to">
            <p><span>Ship to: </span><i>(Address)</i></p>
            <p>Jane Doe</p>
            <p>321 Place for Street</p>
            <p>Name of the City, XY12345</p>
            <p>State</p>
            <p>Phone Number</p>
        </div>
    </div>

</div>
@endsection