@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <img src="{{asset('img/new-arrivals-header.jpg')}}">
        <h1>NEW ARRIVALS</h1>
    </div>

    <div class="row" id="printMoreArrivals">
            @foreach($wines as $wine)
                @include('new-arrival')
            @endforeach
    </div>
    @if(count($wines)>0)
        <div class="col-12 mt-4 mb-5 text-center">
            <div id="loadMoreArrivals">
                <a id="loadMoreArrivalsLink" href="#"
                   data-wine-count="{{ $wine_count }}"
                   class="big-button button red-button margin-0-auto margin-t">Load More</a>
            </div>
        </div>
    @endif
</div>
@endsection