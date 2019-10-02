@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="page-header">
        <img src="{{asset('img/hot-sellers-header.jpg')}}">
        <h1>HOT SELLERS</h1>
    </div>

    <div class="row">

        @foreach($wines as $wine)
        <div class="col-xs-5 vine-box-style-3 style-3-2">
            <a href="/wine/{{$wine->slug}}">
                <div class="image-wrap">
                    <figure class="image-container">
                        <img src="{{$wine->photo}}">
                        <div class="overlay"></div>
                        @if(Auth::user())
                        <favorite
                                :post="'{{ $wine->slug }}'"
                                :favorited="{{ $wine->favorited() ? 'true' : 'false' }}"
                                :type="'wine'"
                        ></favorite>
                        @endif
                    <!--    <span class="sale-mark">SALE</span> -->
                    </figure>
                </div>
                <div class="product-info">
                    <h5>{{$wine->name}}</h5>
                    <h4>${{$wine->price}}</h4>
                    <div class="star-rating">
                        <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$wine->rating()}}"></star-rating>
                    </div>
                    <span class="order-q">{{ $wine->orders_count }} Orders</span>
                </div>
            </a>
        </div>
        @endforeach

    </div>
</div>
@endsection