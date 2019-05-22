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
                        </div>
                        <h5>{{$result->name}}</h5>
                        <small>{{$result->description}}</small>
                    </a>
                </div>
            @endforeach

            {{ $results->links() }}
        </div>
    </div>
@endsection