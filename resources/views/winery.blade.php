@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/winery-1.jpg')}}">
        <img class="wine-badge" src="{{asset('img/badge.png')}}">
    </div>

    <div class="row winery-info">
        <img class="winery-logo-big" src="{{asset('img/winery-logo-1.jpg')}}">
        <div>
            <h1>{{$winery->name}}</h1>
            <div class="star-rating">
                <rating :post="'{{$winery->slug}}'" :rating="{{$winery->rating()}}" :type="'winery'"></rating>
            </div>
            <p>{{$winery->ratingCount()}} Feedback</p>
        </div>
    </div>

    <div class="row padding-row">
        <div class="wine-description">
            <ul class="nav nav-tabs row">
                <li class="cat-tab active col-6 center-text"><a data-toggle="tab" href="#description" class="active">CATEGORIES</a></li>
                <li class="cat-tab col-6 center-text"><a data-toggle="tab" href="#info">WINES</a></li>
            </ul>

            <div class="tab-content">
                <div id="description" class="tab-pane fade in active show">

                    <div class="row winery-categories">
                        <h2 class="center-text">Red Wine</h2>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row winery-categories">
                        <h2 class="center-text">White Wine</h2>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row winery-categories">
                        <h2 class="center-text">Rosé Wine</h2>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                
                <div id="info" class="tab-pane fade">
                    <div class="row winery-categories">
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-5 vine-box-style-4">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <span class="price">$21.00</span>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection