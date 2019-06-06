@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row padding-row">
            <h1 class="headline-2">Search for "{{$searchstr}}"</h1>
        </div>
        <div class="row">
            @foreach ($results as $result)
                <div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">
                    <a href="{{$result->type==='WINE'?route('wine.show', ['wine' => $result->slug]):route('winery', ['winery' => $result->slug])}}">
                        <div class="image-container">
                            <img src=" {{ $result->photo }}">
                            <div class="overlay"></div>
                            <h5>{{$result->name}}</h5>
                            <small>{{$result->description}}</small>
                            @if($result->type==='WINE')
                                @if(Auth::user())
                                    <favorite
                                            :post="'{{ $result->slug }}'"
                                            :favorited="{{ $result->favorited ? 'true' : 'false' }}"
                                            :type="'wine'"
                                    ></favorite>
                                @endif
                                <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$result->rating}}"></star-rating>
                                <div class="wine-price">
                                    ${{$result->price}}
                                </div>
                                <span class="order-q">{{$result->orders_count}} Orders</span>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
            {{ $results->links() }}
        </div>
    </div>
@endsection