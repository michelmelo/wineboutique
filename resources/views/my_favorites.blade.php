@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/wines-header.jpg')}}">
        <h1>FAVORITE WINES</h1>
    </div>

    <div class="row">


        <div class="col-lg-10 col-sm-12 row row-eq-height">
            @foreach ($myFavorites as $myFavorite)
                <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                    <a href="{{route('wine.show', ['wine' => $myFavorite->slug])}}">
                        <div class="image-container">
                            <img src="{{$myFavorite->getPhotoLink()}}">
                            <div class="overlay"></div>
                            <favorite
                                    :post="'{{ $myFavorite->slug }}'"
                                    :favorited="{{ $myFavorite->favorited() ? 'true' : 'false' }}"
                                    :type="'wine'"
                            ></favorite>
                            <span class="sale-mark">SALE</span>
                        </div>
                        <h5>{{$myFavorite->name?$myFavorite->name:'Name of wine'}}</h5>
                        <h4>${{$myFavorite->price}}</h4>

                        <div class="star-rating">
                            <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$myFavorite->rating()}}"></star-rating>
                        </div>
                        <span class="order-q">193 Orders</span>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection