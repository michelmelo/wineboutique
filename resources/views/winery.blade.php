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
                <rating :post="'{{$winery->slug}}'" :rating="{{$winery->rating()}}" :readonly="{{ Auth::check() ? 'false' : 'true' }}" :type="'winery'"></rating>
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
                <div id="info" class="tab-pane fade in active show">
                    @foreach($winery->wines->groupBy('varietal.name') as $wineGroupName => $wineGroup)
                        <div class="row winery-categories">
                            <h2 class="center-text">{{$wineGroupName}} Wine</h2>
                            @foreach($wineGroup as $wine)
                                <div class="col-xs-5 vine-box-style-4">
                                    <a href="{{route('wine.show', ['wine' => $wine->slug])}}">
                                        <div class="image-container">
                                            <img src="{{$wine->photo}}">
                                            <span class="price">${{$wine->price}}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                </div>
                
                <div id="description" class="tab-pane fade">
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