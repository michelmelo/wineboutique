@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/wines-header.jpg')}}">
        <h1>FAVORITE WINES</h1>
    </div>

    @if(count($myFavorites))
        <my-favorites :favorites="{{$myFavorites}}" :orders="{{json_encode($orderNo)}}"></my-favorites>
    @else
        <p style="text-align: center">No wines added to favorites.</p>
    @endif
</div>
@endsection