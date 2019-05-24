@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row">
        <div class="col-lg-6 col-sm-12 preview">
            <div class="preview-pic tab-content single-wine-img">
                <div class="tab-pane active" id="pic-1"><img src="{{ $wine->photo }}" ></div>
                <div class="tab-pane" id="pic-2"><img src="{{ route('images.wine', ['slug' => $wine->slug . '.jpg']) }}" ></div>
                <div class="tab-pane" id="pic-3"><img src="{{ route('images.wine', ['slug' => $wine->slug . '.jpg']) }}" ></div>
                @if(Auth::user())
                <favorite
                        :post="'{{ $wine->slug }}'"
                        :favorited="{{ $wine->favorited() ? 'true' : 'false' }}"
                ></favorite>
                @endif
            </div>
            <!-- <ul class="preview-thumbnail nav nav-tabs">
                <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{ route('images.wine', ['slug' => $wine->slug . '.jpg']) }}" ></a></li>
                <li><a data-target="#pic-2" data-toggle="tab"><img src="{{asset('img/single-2.png')}}" /></a></li>
                <li><a data-target="#pic-3" data-toggle="tab"><img src="{{asset('img/single-2.png')}}" /></a></li>
            </ul> -->
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
                    <span>{{ $orders_count->cnt }}</span>
                </div>

                <div class="col-4 center-text">
                    <p>RATING</p>
                    <rating :post="'{{ $wine->slug }}'" :rating="{{$wine->rating()}}" :readonly="{{ Auth::check() ? 'false' : 'true' }}" :type="'wine'"></rating>
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
                
                <div id="info" class="tab-pane fade in">
                    <p class="winery-name">{{$wine->winery->name}}</p>
                    <p class="winery-description">{{$wine->winery->description}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 row row-eq-height padding-row">
        <h2 class="heading">RECOMMENDATIONS</h2>
        @foreach($recommendations as $recommendation)
            <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                <a href="{{route('wine.show', ['wine' => $recommendation->slug])}}">
                    <div class="image-container">
                        <img src="{{ $recommendation->photo }}">
                        <div class="overlay"></div>
                    </div>
                    <h5>{{ $recommendation->name }}</h5>
                    <h4>${{ $recommendation->price }}</h4>
                    <div class="star-rating">
                        @for($i = 0; $i<intval($recommendation->avg_rating);$i++)
                            <span class="fa fa-star checked"></span>
                        @endfor
                        @for($i = intval($recommendation->avg_rating); $i<5;$i++)
                            <span class="fa fa-star"></span>
                        @endfor
                    </div>
                    <span class="order-q">{{ $recommendation->orders_count }} Orders</span>
                </a>

            </div>
        @endforeach
        {{ $recommendations->links() }}
    </div>

</div>
@endsection