@extends('layouts.app')

@section('content')
    <div class="container-fluid">
          <div class="row padding-row">
            <h1 class="headline-2">Search for "{{$searchstr}}"</h1>
        </div>
    </div>
    <div class="container">
      
        <div class="row vine-boxes">
            @foreach ($results as $result)
                <div class="col-xs-3 vine-box-style-3 style-3-2">
                    <a href="{{$result->type==='WINE'?route('wine.show', ['wine' => $result->slug]):route('wine.show', ['wine' => $result->slug])}}">
                        <div class="image-wrap">
                            <figure class="image-container">
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
                            </figure>
                        </div>
                        <div class="product-info">
                            <h5>{{$result->name}}</h5>
                            <div class="star-rating price">
                                <h4 class="m-0 p-0">${{$result->price}}</h4>
                                <star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="{{$result->rating}}"></star-rating>
                            </div>
                            @if($result->wine_orders()->sum("quantity") > 0)
                                <span class="order-q">{{$result->wine_orders()->sum("quantity")}} Sold</span>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        @if(count($results)>0)
            <div class="col-12 mt-4 mb-5 text-center">
                @include('layouts.partials.load_more')
            </div>
        @endif
    </div>
@endsection