@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row">
        <div class="col-lg-6 col-sm-12 preview">
            <div class="preview-pic tab-content single-wine-img">
                <div class="tab-pane active" id="pic-1"><img src="{{asset('img/single-1.png')}}" /></div>
                <div class="tab-pane" id="pic-2"><img src="{{asset('img/single-2.png')}}" /></div>
                <div class="tab-pane" id="pic-3"><img src="{{asset('img/single-2.png')}}" /></div>
                <i class="fas fa-heart"></i>
            </div>
            <ul class="preview-thumbnail nav nav-tabs">
                <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{asset('img/single-1.png')}}" /></a></li>
                <li><a data-target="#pic-2" data-toggle="tab"><img src="{{asset('img/single-2.png')}}" /></a></li>
                <li><a data-target="#pic-3" data-toggle="tab"><img src="{{asset('img/single-2.png')}}" /></a></li>
            </ul>
        </div>

        <div class="col-lg-6 col-sm-12 single-wine-info">
            <h1>Place Holder of the Name of the Wine</h1>
            <p class="price">$27.00</p>

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
                    <div class="star-rating">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>

            <div class="row single-wine-buttons">
                <a href="#" class="button pink-button full-width">ADD TO CART</a>
                <a href="#" class="button red-button full-width">BUY NOW</a>
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
                    <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>

                    <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>
                </div>
                
                <div id="info" class="tab-pane fade">
                    <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content. Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>
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