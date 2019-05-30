@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/wineries-header.jpg')}}">
        <h1>WINERIES</h1>
    </div>

    <div class="row padding-row vine-boxes">
        @foreach ($wineries as $winery)
            <div class="col-lg-6 wineries-box">
                <div>
                    <div class="wineries-brand">
                        <img class="winery-header" src="{{ $winery->cover==null ? asset('img/winery-1.jpg') : '/images/winery/cover/'.$winery->cover }}">
                        <img class="winery-logo" src="{{ $winery->profile==null ? asset('img/winery-logo-1.jpg') : '/images/winery/profile/'.$winery->profile }}">
                    </div>
                    <p><a href="{{route('winery', $winery->slug)}}">{{$winery->name}}</a></p>
                </div>
                @if(count($winery->wines)>0)
                    <div class="latest-wines-list">
                        @foreach($winery->wines as $topWine)
                            <div class="top-wine">
                                <a href="{{url('/wine/'.$topWine->slug)}}">
                                    <img src="{{$topWine->photo}}">
                                    <div class="pricing">
                                        ${{ sprintf('%0.2f', $topWine->price) }}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @include('layouts.partials.load_more')
</div>
@endsection