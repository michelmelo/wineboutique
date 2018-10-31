@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/wineries-header.jpg')}}">
        <h1>WINERIES</h1>
    </div>

    <div class="row padding-row">
        @foreach ($wineries as $winery)
            <div class="col-lg-6 wineries-box">
                <div>
                    <div class="wineries-brand">
                        <img class="winery-header" src="{{asset('img/winery-1.jpg')}}">
                        <img class="winery-logo" src="{{asset('img/winery-logo-1.jpg')}}">
                    </div>
                    <p><a href="{{route('winery', $winery->slug)}}">{{$winery->name}}</a></p>
                </div>
            </div>
        @endforeach
        
        {{ $wineries->links() }}
    </div>
</div>
@endsection