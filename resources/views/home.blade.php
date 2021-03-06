@extends('layouts.app')

@section('content')
@if(request()->session()->has('successMsg'))
    <div class="alert alert-success"> {{ request()->session()->get('successMsg') }}</div>
    <script> setTimeout(function () { $('.alert-success').hide()}, 10000) </script>
@endif
<div class="container-fluid p-0 home">
    <div class="home-slider row">
        <div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="slide-title">
                    <h1 class="color-w">Curated Online Wine Shop</h1>
                </div>
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('img/home-slider/slide-1.jpg')}}" alt="First slide">
                    <div class="slider-content">
                        <a href="{{route('wine.list')}}" class="button red-button">SHOP NOW</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/home-slider/slide-1.jpg')}}" alt="Second slide">
                    <div class="slider-content">
                        <a href="{{route('wine.list')}}" class="button red-button">SHOP NOW</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/home-slider/slide-1.jpg')}}" alt="Third slide">
                    <div class="slider-content">
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

</div>
<div class="container home">

    @if(count($topWineries)>0)
    <div class="row padding-row row-eq-height">
        <h2 class="heading mb-5">TOP RATED WINERIES</h2>
        <div class="main__clipper col-12">
            <div class="main__scroller row">
                @foreach($topWineries as $topWinery)
                    <div class="col-xs-5ths vine-box-style-1">
                        <a href="{{route('winery', ['winery' => $topWinery->slug])}}">
                            <div class="image-wrap">
                                <figure class="image-container">
                                    <img src="{{ $topWinery->cover?'/images/winery/cover/'.$topWinery->cover:asset('img/vine-style-1-img.jpg') }}">
                                    <div class="overlay"></div>
                                </figure>
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
    @endif

    <div class="row padding-row">
        <h2 class="heading mb-5">SHOP BY CATEGORY</h2>

        <div id="accordion" class="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <img src="{{asset('img/varietal-icon.png')}}"><span class="accordion-name">VARIETAL</span>
                            <i class="fas fa-chevron-down"></i>
                            <i class="fas fa-chevron-up"></i>
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
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
                        <a href="/wines?price[]=1" class="sub-cat">5-50</a>
                        <a href="/wines?price[]=2" class="sub-cat">51-100</a>
                        <a href="/wines?price[]=3" class="sub-cat">100+</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row padding-row row-eq-height new-arrivals">
        <h2 class="heading mb-5">NEW ARRIVALS</h2>
        <div class="col-12 main__clipper">
            <div class="main__scroller row">
                @foreach($latestWines as $latestWine)
                    <div class="col-lg-4 col-sm-6 col-xs-6 vine-box-style-2">
                        <a href="{{route('wine.show', ['wine' => $latestWine->slug])}}">
                            <div  class="row">
                                <div class="col-6 px-0 img-wrap">
                                <!-- <img src="{{asset('img\vine-style-2-img.PNG')}}"> -->
                                    <img src="{{ $latestWine->photo }}" >
                                </div>
                                <div class="col-6 py-3">
                                    <h5 class="name">{{$latestWine->name}}</h5>
                                    <h5 class="price"><span class="mr-2">$</span>{{number_format($latestWine->price, 2, '.', ',')}}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <a href="/new-arrivals" class="button red-button margin-0-auto margin-t">SEE MORE</a>
    </div>

    <div class="row padding-row row-eq-height">
        <h2 class="heading mb-5">TOP RATED WINES</h2>
        @foreach($topRatedWines as $wine)
            <div class="col-md-3 col-sm-4 col-xs-6 vine-box-style-3">
                <a href="{{route('wine.show', ['wine' => $wine->slug])}}">
                    <div class="image-wrap">
                        <figure class="image-container">
                            <!-- <img src="{{asset('img/vine-style-3-img.png')}}"> -->
                            <img src="{{ $wine->photo }}" >
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
                        <h5>{{$wine->name?$wine->name:'Name of wine'}}</h5>

                        <div class="star-rating price">
                            <h4 class="m-0 p-0">${{number_format($wine->price, 2, '.', ',')}}</h4>
                            <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$wine->rating()}}"></star-rating>
                        </div>

                        @if($wine->wine_orders()->sum("quantity") > 0)
                            <span class="order-q">{{$wine->wine_orders()->sum("quantity")}} Sold</span>
                        @endif
                    </div>
                </a>
            </div>
        @endforeach
        <div class="col-12 text-center mt-5">
            <a href="/wines/top-rated" class="button red-button margin-0-auto">SEE MORE</a>
        </div>
    </div>

    <div class="row padding-row center-text secure-section">
        <h2 class="heading mb-5">YOU’RE SECURE WITH US</h2>

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
            <img src="{{asset('img/pin-truck.png')}}">
            <h4>TRACKING</h4>
            <p>Our CEO said we have to tell you that this is the placeholder area for which you will need to give us content.</p>
        </div>
    </div>
</div>
@endsection
