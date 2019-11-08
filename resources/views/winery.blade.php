@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{ $winery->cover==null ? asset('img/winery-1.jpg') : '/images/winery/cover/'.$winery->cover }}">
        <img class="wine-badge" src="{{asset('img/badge.png')}}">
    </div>

    <div class="row winery-info">
        <img class="winery-logo-big" src="{{ $winery->profile==null ? asset('img/winery-logo-1.jpg') : '/images/winery/profile/'.$winery->profile }}">
        <div>
            <h1>{{$winery->name}}</h1>
            <div class="star-rating">
                <rating :post="'{{$winery->slug}}'" :rating="{{$winery->rating()}}" :readonly="{{ Auth::check()&&Auth::user()->type!=='SELLER' ? 'false' : 'true' }}" :type="'winery'"></rating>
            </div>
            <p>{{$winery->ratingCount()}} Feedback</p>
        </div>
        <div class="winery-desc col-12">
            <h3>Description</h3>
            <p>{{$winery->description}}</p>
        </div>
    </div>

    <div class="row padding-row">
        <div class="wine-description">
            <ul class="nav nav-tabs row">
                <li class="cat-tab col-12 active center-text"><a data-toggle="tab" href="#info" class="active">WINES</a></li>
            </ul>

            <div class="tab-content">
                <div id="info" class="tab-pane fade in active show wineries-box">
                    @foreach($winery->wines->groupBy('varietal.name') as $wineGroupName => $wineGroup)
                        <div class="row winery-categories">
                            <h2 class="center-text">{{$wineGroupName}} Wine</h2>
                            @foreach($wineGroup as $wine)
                                <div class="col-xs-5 vine-box-style-3 style-3-2">
                                    <a href="{{route('wine.show', ['wine' => $wine->slug])}}">
                                        <div class="image-wrap">
                                            <figure class="image-container">
                                                <img src="{{$wine->photo}}"> 
                                                <div class="overlay"></div>
                                                @if(Auth::user())
                                                    <favorite
                                                            :post="'{{ $wine['slug'] }}'"
                                                            :favorited="{{ $wine->favorited() ? 'true' : 'false' }}"
                                                            :type="'wine'"
                                                    ></favorite>
                                                @endif
                                            </figure>
                                        </div>
                                        <div class="product-info">
                                            <h5>{{$wine->name}}</h5>
                                            <div class="star-rating price">
                                                <h4 class="m-0 p-0">${{$wine->price}}</h4>
                                                <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$wine->rating()}}"></star-rating>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                </div>
                
                <div id="description" class="tab-pane fade wineries-box">
                    <div class="row winery-categories">
                        @foreach($winery->wines as $wine)
                            <div class="col-xs-5 vine-box-style-4">
                                <a href="{{route('wine.show', ['wine' => $wine->slug])}}">
                                    <div class="image-container">
                                        <img src="{{$wine->getPhotoLink()}}">
                                        <span class="price">${{$wine->price}}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection