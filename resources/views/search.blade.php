@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row padding-row">
            <h1 class="headline-2">Search for "{{$searchstr}}"</h1>
        </div>
        <div class="row vine-boxes">
            @foreach ($results as $result)
                @if($result->type==='WINE')
                <div class="col-xs-5 vine-box-style-3 style-3-2">
                    <a href="{{$result->type==='WINE'?route('wine.show', ['wine' => $result->slug]):route('winery', ['winery' => $result->slug])}}">
                        <div class="image-container">
                            <img src=" {{ $result->photo }}">
                            <div class="overlay"></div>

                            @if(Auth::user())
                                <favorite
                                        :post="'{{ $result->slug }}'"
                                        :favorited="{{ $result->favorited() ? 'true' : 'false' }}"
                                        :type="'wine'"
                                ></favorite>
                            @endif

                            <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$result->rating()}}"></star-rating>
                            <div class="wine-price">
                                ${{$result->price}}
                            </div>
                            <span class="order-q">{{$result->orders_count}} Orders</span>
                        </div>
                        <div class="product-info">
                            <h5>{{$result->name}}</h5>
                            <h4 class="wine-price">
                                ${{$result->price}}
                            </h4>
                            <div class="star-rating">
                                <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$result->rating}}"></star-rating>
                            </div>
                            <span class="order-q">{{$result->orders_count}} Orders</span>
                        </div>
                    </a>
                </div>
                @endif
            @endforeach
        </div>
        @if(count($results)>0)
            <div class="col-12 mt-4 mb-5 text-center">
                @include('layouts.partials.load_more')
            </div>
        @endif
    </div>
@endsection