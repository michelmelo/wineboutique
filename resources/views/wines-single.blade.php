@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row">
        <div class="col-lg-6 col-sm-12 preview" id="slider">
            <div id="wineCarousel" class="carousel slide wine-slider">
                <!-- main slider carousel items -->
                <div class="carousel-inner preview-pic">
                    @if(Auth::user())
                        <favorite
                                :post="'{{ $wine->slug }}'"
                                :favorited="{{ $wine->favorited() ? 'true' : 'false' }}"
                        ></favorite>
                    @endif

                    <div class="active carousel-item" data-slide-number="0">
                        <div class="carousel-image">
                            <img src="{{ $wine->photo }}" class="img-fluid">
                        </div>
                    </div>

                    @foreach($wine_images as $img)
                        <div class="carousel-item" data-slide-number="{{$loop->iteration}}">
                            <div class="carousel-image">
                                <img src="{{ route('images.wine', ['slug' => $img->slug . '.jpg']) }}" class="img-fluid">
                            </div>
                        </div>
                    @endforeach

                    <a class="carousel-control-prev" href="#wineCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#wineCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
                <!-- main slider carousel nav controls -->
                <ul class="carousel-indicators list-inline mx-auto px-2 mt-3 w-100">
                    <li class="list-inline-item active">
                        <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#wineCarousel">
                            <img src="{{ $wine->photo }}" class="img-fluid">
                        </a>
                    </li>
                    @foreach($wine_images as $img)
                        <li class="list-inline-item">
                            <a id="carousel-selector-{{$loop->iteration}}" data-slide-to="{{$loop->iteration}}" data-target="#wineCarousel">
                                <img src="{{ route('images.wine', ['slug' => $img->slug . '.jpg']) }}" class="img-fluid">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 single-wine-info">
            <h1>{{$wine->name}}</h1>
            <p class="price">${{$wine->price}}</p>

            <div class="row">
                <div class="col-4 center-text">
                    <p>SHIPPING</p>
                    <span class="color-r">{{$wine->winery->winery_shippings->min('price')}} $</span>
                </div>

                <div class="col-4 center-text">
                    <p>WE SOLD</p>
                    <span>{{ $wine->wine_orders()->sum("quantity") }}</span>
                </div>

                <div class="col-4 center-text">
                    <p>RATING</p>
                    <rating :post="'{{ $wine->slug }}'" :rating="{{$wine->rating()}}" :readonly="{{ Auth::check()&&Auth::user()->type!=='SELLER' ? 'false' : 'true' }}" :type="'wine'"></rating>
                </div>
            </div>


            @if(!Auth::user()||(Auth::user()&&Auth::user()->type!=='SELLER'))
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
            @endif
        </div>
    </div>


    <div class="row padding-row">
        <div class="wine-description">
            <ul class="nav nav-tabs row">
                <li class="cat-tab active col-6 center-text pr-0"><a data-toggle="tab" href="#description" class="active">DESCRIPTION</a></li>
                <li class="cat-tab active col-6 center-text pl-0"><a data-toggle="tab" href="#info">WINERY INFO</a></li>
            </ul>

            <div class="tab-content">
                <div id="description" class="tab-pane fade in active show">
                    <p>{{$wine->description}}</p>
                </div>

                <div id="info" class="tab-pane fade in">
                    <p class="winery-name">{{$wine->winery->name}}</p>
                    <p class="winery-description">{{$wine->winery->description}}</p>
                </div>
            </div>
        </div>
    </div>

    @if(count($recommendations) > 0)
    <div class="col-lg-12 col-sm-12 row row-eq-height padding-row">
        <h2 class="heading">RECOMMENDATIONS</h2>
        @foreach($recommendations as $recommendation)
            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                <a href="{{route('wine.show', ['wine' => $recommendation->slug])}}">
                    <div class="image-wrap">
                        <figure class="image-container">
                            <img src="{{ $recommendation->photo }}">
                            <div class="overlay"></div>
                        </figure>
                    </div>
                    <div class="product-info">
                        <h5>{{ $recommendation->name }}</h5>
                        <div class="star-rating price">
                            <h4 class="m-0 p-0">${{ $recommendation->price }}</h4>
                            @for($i = 0; $i<intval($recommendation->avg_rating);$i++)
                                <span class="fa fa-star checked"></span>
                            @endfor
                            @for($i = intval($recommendation->avg_rating); $i<5;$i++)
                                <span class="fa fa-star"></span>
                            @endfor
                        </div>
                        <span class="order-q">{{ $recommendation->orders_count }} Sold</span>
                    </div>
                </a>

            </div>
        @endforeach
{{--        {{ $recommendations->links() }}--}}
    </div>
    @endif

</div>
@endsection
