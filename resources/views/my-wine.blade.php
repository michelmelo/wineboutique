@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/my-wine-header.jpg')}}">
        <h1>MY WINE</h1>
    </div>

    <div class="row center-text my-wine">
        <div class="col-md-4">
            <a href="#">
                <div>
                    <div class="image-holder">
                        <img src="{{asset('img/track-order.png')}}">
                        <img src="{{asset('img/track-order-a.png')}}">
                    </div>
                </div>
                <div>
                    <h2>TRACK YOUR ORDER</h2>
                    <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. </p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="#">
                <div class="wish1">
                    <div class="image-holder">
                        <img src="{{asset('img/wishlist.png')}}">
                        <img src="{{asset('img/wishlist-a.png')}}">
                    </div>
                </div>
                <div>
                    <h2>WISHLIST</h2>
                    <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. </p>
                </div>
                <div class="col-4 wish2">
                    <div class="image-holder">
                        <img src="{{asset('img/wishlist.png')}}">
                        <img src="{{asset('img/wishlist-a.png')}}">
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="#">
                <div>
                    <div class="image-holder">
                        <img src="{{asset('img/pickup.png')}}">
                        <img src="{{asset('img/pickup-a.png')}}">
                    </div>
                </div>
                <div>
                    <h2>LOCAL PICKUP</h2>
                    <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. </p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection