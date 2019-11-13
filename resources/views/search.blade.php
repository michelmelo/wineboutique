@extends('layouts.app')

@section('content')
    <div class="container-fluid">
          <div class="row padding-row">
            <h1 class="headline-2">Wines for "{{$searchstr}}"</h1>
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
                            <span class="order-q">{{$result->wine_orders()->sum("quantity")}} Sold</span>
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
<!-------------------------------WINERIES----------------------->

<!--

    <div class="container-fluid">
          <div class="row padding-row">
            <h2 class="headline-2 m-0">Winearise Results for "{{$searchstr}}"</h2>
        </div>
    </div>
 <div class="container">
     <div class="row padding-row vine-boxes">




            <div class="col-lg-6 wineries-box px-0 ">
                <div>
                    <a href="#">
                        <div class="wineries-brand">
                            <img class="winery-header" src="{{asset('img/winery-1.jpg')}}" height="165px">
                            <img class="winery-logo" src="{{asset('img/winery-logo-1.jpg')}}">
                        </div>
                        <p>test</p>
                    </a>                   
                </div>
            </div>
      
    

            <div class="col-lg-6 wineries-box px-0 ">
                <div>
                    <a href="#">
                        <div class="wineries-brand">
                            <img class="winery-header" src="{{asset('img/winery-1.jpg')}}" height="165px">
                            <img class="winery-logo" src="{{asset('img/winery-logo-1.jpg')}}">
                        </div>
                        <p>test</p>
                    </a>             
                </div>
            </div>




      
    </div> -->
    <!-------------------------------WINERIES----------------------->

    </div>
@endsection