@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/new-arrivals-header.jpg')}}">
        <h1>NEW ARRIVALS</h1>
    </div>

    <div class="row">

        @foreach($wines as $wine)
        <div class="col-xs-5 vine-box-style-3 style-3-2">
            <a href="#">
                <div class="image-container">
                    <img src="{{$wine->getPhotoLink()}}">
                    <div class="overlay"></div>
                    <favorite
                            :post="'{{ $wine->slug }}'"
                            :favorited="{{ $wine->favorited() ? 'true' : 'false' }}"
                            :type="'wine'"
                    ></favorite>
                    <span class="sale-mark">SALE</span>
                </div>
                <h5>{{$wine->name}}</h5>
                <h4>${{$wine->price}}</h4>
                <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$wine->rating()}}"></star-rating>
                <span class="order-q">193 Orders</span>
            </a>
        </div>
        @endforeach

    </div>
</div>
@endsection