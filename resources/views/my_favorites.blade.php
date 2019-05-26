@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/wines-header.jpg')}}">
        <h1>FAVORITE WINES</h1>
    </div>

    <div class="row">
        
        <favorite
            :my-favorites="{{ $myFavorites }}"
            :order-no="{{ $orderNo }}"
            :type="'wine'"
        ></favorite>
                            
    </div>
</div>
@endsection