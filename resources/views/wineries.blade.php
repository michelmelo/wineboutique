@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
     <div class="page-header">
        <img src="{{asset('img/wineries-header.jpg')}}">
        <h1>WINERIES</h1>
    </div>
</div>
<div class="container">
   

    <div class="row padding-row vine-boxes">
        @foreach ($wineries as $winery)
            <div class="col-lg-6 wineries-box px-0 px-md-4">
                <div>
                    <a href="{{route('winery', $winery->slug)}}">
                        <div class="wineries-brand">
                            <img class="winery-header" src="{{ $winery->cover==null ? asset('img/winery-1.jpg') : '/images/winery/cover/'.$winery->cover }}" height="165px">
                            <img class="winery-logo" src="{{ $winery->profile==null ? asset('img/winery-logo-1.jpg') : '/images/winery/profile/'.$winery->profile }}">
                        </div>
                        <p>{{$winery->name}}</p>
                    </a>
                    @if(count($winery->wines)>0)
                        <div class="row latest-wines-list px-3 mt-4">
                            @foreach($winery->wines->take(3)  as $topWine)
                                <div class="top-wine col-4 vine-box-style-4 px-2">
                                    <a href="{{url('/wine/'.$topWine->slug)}}">
                                        <div class="image-container">
                                            <img src="{{$topWine->photo}}">
                                            <span class="pricing price">
                                                ${{ sprintf('%0.2f', $topWine->price) }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12 mt-4 mb-5 text-center">
            @include('layouts.partials.load_more')
        </div>
    </div>
</div>
@endsection