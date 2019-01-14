@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row">
        <div class="col-lg-6 col-sm-12 preview">
            <div class="preview-pic tab-content single-wine-img">
                <div class="tab-pane active" id="pic-1"><img src="{{$wine->getPhotoLink()}}" /></div>
                <favorite
                        :post="'{{ $wine->slug }}'"
                        :favorited="{{ $wine->favorited() ? 'true' : 'false' }}"
                ></favorite>
            </div>
            <ul class="preview-thumbnail nav nav-tabs">
                <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{$wine->getPhotoLink()}}" /></a></li>
            </ul>
        </div>

        <div class="col-lg-6 col-sm-12 single-wine-info">
            <h1>{{$wine->name}}</h1>
            <p class="price">${{$wine->price}}</p>

            <div class="row">
                <div class="col-4 center-text">
                    <p>SHIPPING</p>
                    <span class="color-r">$5.26</span>
                </div>

                <div class="col-4 center-text">
                    <p>ORDERS</p>
                    <span>379</span>
                </div>

                <div class="col-4 center-text">
                    <p>RATING</p>
                    <rating :post="'{{ $wine->slug }}'" :rating="{{$wine->rating()}}" :type="'wine'"></rating>
                </div>
            </div>

            <div class="row single-wine-buttons">
                @if(Auth::check())
                    <add-to-cart wine-id="{{$wine->id}}"></add-to-cart>
                @else
                    <a href="{{route('login')}}" class="button pink-button full-width">ADD TO CART</a>
                @endif
                
                @if(Auth::check())
                    <buy-now wine-id="{{$wine->id}}"></buy-now>
                @else
                    <a href="{{route('login')}}" class="button red-button full-width">BUY NOW</a>
                @endif
               
            </div>
        </div>
    </div>


    <div class="row padding-row">
        <div class="wine-description">
            <ul class="nav nav-tabs row">
                <li class="cat-tab active col-6 center-text"><a data-toggle="tab" href="#description" class="active">DESCRIPTION</a></li>
                <li class="cat-tab col-6 center-text"><a data-toggle="tab" href="#info">WINERY INFO</a></li>
            </ul>

            <div class="tab-content">
                <div id="description" class="tab-pane fade in active show">
                    <p>{{$wine->description}}</p>
                </div>
                
                <div id="info" class="tab-pane fade">
                    <p>{{$wine->winery->description}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 row row-eq-height padding-row">
        <h2 class="heading">RECOMMENDATIONS</h2>
        <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
            <a href="#">
                <div class="image-container">
                    <img src="{{asset('img/vine-style-3-img.png')}}">
                    <div class="overlay"></div>
                    <i class="far fa-heart"></i>
                    <span class="sale-mark">SALE</span>
                </div>
                <h5>Name Of The Store</h5>
                <h4>$49.00</h4>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="order-q">193 Orders</span>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
            <a href="#">
                <div class="image-container">
                    <img src="{{asset('img/vine-style-3-img.png')}}">
                    <div class="overlay"></div>
                    <i class="far fa-heart"></i>
                    <span class="sale-mark">SALE</span>
                </div>
                <h5>Name Of The Store</h5>
                <h4>$49.00</h4>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="order-q">193 Orders</span>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
            <a href="#">
                <div class="image-container">
                    <img src="{{asset('img/vine-style-3-img.png')}}">
                    <div class="overlay"></div>
                    <i class="far fa-heart"></i>
                    <span class="sale-mark">SALE</span>
                </div>
                <h5>Name Of The Store</h5>
                <h4>$49.00</h4>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="order-q">193 Orders</span>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
            <a href="#">
                <div class="image-container">
                    <img src="{{asset('img/vine-style-3-img.png')}}">
                    <div class="overlay"></div>
                    <i class="far fa-heart"></i>
                    <span class="sale-mark">SALE</span>
                </div>
                <h5>Name Of The Store</h5>
                <h4>$49.00</h4>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="order-q">193 Orders</span>
            </a>
        </div>
        <a href="#" class="button red-button margin-0-auto margin-t">SEE MORE</a>
    </div>

</div>
@endsection