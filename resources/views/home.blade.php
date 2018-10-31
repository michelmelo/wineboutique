@extends('layouts.app')

@section('content')
<div class="container">
    <div class="home-slider">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('img/home-slider/slide-1.jpg')}}" alt="First slide">
                    <div class="slider-content">
                        <h1 class="color-w">WELCOME TO WINE BOUTIQUE</h1>
                        <a href="{{route('wine.list')}}" class="button red-button">SHOP NOW</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/home-slider/slide-1.jpg')}}" alt="Second slide">
                    <div class="slider-content">
                        <h1 class="color-w">WELCOME TO WINE BOUTIQUE</h1>
                        <a href="{{route('wine.list')}}" class="button red-button">SHOP NOW</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/home-slider/slide-1.jpg')}}" alt="Third slide">
                    <div class="slider-content">
                        <h1 class="color-w">WELCOME TO WINE BOUTIQUE</h1>
                        <a href="{{route('wine.list')}}" class="button red-button">SHOP NOW</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="row padding-row row-eq-height">
        <h2 class="heading">TOP RATED WINERIES</h2>
        <div class="main__clipper">
            <div class="main__scroller row">
                @foreach($topWineries as $topWinery)
                    <div class="col-xs-5ths vine-box-style-1">
                        <a href="{{route('winery', ['winery' => $topWinery->slug])}}">
                            <div class="image-container">
                                <img src="{{asset('img/vine-style-1-img.jpg')}}">
                                <div class="overlay"></div>
                            </div>
                            <h5>{{$topWinery->name}}</h5>
                            <div class="star-rating">
                                <star-rating :star-size="20" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$topWinery->rating}}"></star-rating>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row padding-row">
        <h2 class="heading">SHOP BY CATEGORY</h2>

        <div id="accordion" class="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <img src="{{asset('img/varietal-icon.png')}}"><span class="accordion-name">VARIETAL</span>
                            <i class="fas fa-chevron-down"></i>
                            <i class="fas fa-chevron-up"></i>
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        @foreach($varietals as $varietal)
                            <a href="/wines?varietal[]={{$varietal->id}}" class="sub-cat">{{$varietal->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <img src="{{asset('img/region-icon.png')}}"><span class="accordion-name">REGION</span>
                            <i class="fas fa-chevron-down"></i>
                            <i class="fas fa-chevron-up"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        @foreach($regions as $region)
                            <a href="/wines?region[]={{$region->id}}" class="sub-cat">{{$region->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <img src="{{asset('img/price-icon.png')}}"><span class="accordion-name">PRICE</span>
                            <i class="fas fa-chevron-down"></i>
                            <i class="fas fa-chevron-up"></i>
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <a href="/wines?price[]=1" class="sub-cat">0-50</a>
                        <a href="/wines?price[]=2" class="sub-cat">51-100</a>
                        <a href="/wines?price[]=3" class="sub-cat">100+</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row padding-row row-eq-height">
        <h2 class="heading">NEW ARRIVALS</h2>
        <div class="main__clipper">
            <div class="main__scroller row">
                @foreach($latestWines as $latestWine)
                    <div class="col-lg-4 col-sm-6 col-xs-6 vine-box-style-2">
                        <a href="{{route('wine.show', ['wine' => $latestWine->slug])}}">
                            <div  class="row">
                                <div class="col-md-6">
                                    <img src="{{asset('img/vine-style-2-img.PNG')}}">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="name">{{$latestWine->name}}</h5>
                                    <h5 class="price">${{$latestWine->price}}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <a href="/wines" class="button red-button margin-0-auto margin-t">SEE MORE</a>
    </div>

    <div class="row padding-row row-eq-height">
        <h2 class="heading">TOP RATED WINES</h2>
        @foreach($topWines as $topWine)
            <div class="col-md-4 col-sm-6 col-xs-6 vine-box-style-3">
                <a href="{{route('wine.show', ['wine' => $topWine->slug])}}">
                    <div class="image-container">
                        <img src="{{asset('img/vine-style-3-img.png')}}">
                        <div class="overlay"></div>
                        <favorite
                                :post="'{{ $topWine->slug }}'"
                                :favorited="{{ $topWine->favorited==1 ? 'true' : 'false' }}"
                                :type="'wine'"
                        ></favorite>
                    </div>
                    <h5>{{$topWine->name}}</h5>
                    <h4>${{$topWine->price}}</h4>
                    <div class="star-rating">
                        <star-rating :star-size="20" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$topWine->rating}}"></star-rating>
                    </div>
                    <span class="order-q">0 Orders</span>
                </a>
            </div>
        @endforeach

        <a href="/wines" class="button red-button margin-0-auto">SEE MORE</a>
    </div>

    <div class="row padding-row center-text secure-section">
        <h2 class="heading">YOU’RE SECURE WITH US</h2>

        <div class="col-md-4">
            <img src="{{asset('img/truck-icon.png')}}">
            <h4>EXPEDITED SHIPPING</h4>
            <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>
        </div>
        <div class="col-md-4">
            <img src="{{asset('img/card-icon.png')}}">
            <h4>PROTECTED PAYMENTS</h4>
            <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>
        </div>
        <div class="col-md-4">
            <img src="{{asset('img/truck-icon.png')}}">
            <h4>TRACKING</h4>
            <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>
        </div>
    </div>
</div>
@endsection
