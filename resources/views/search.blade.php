@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row padding-row">
            <h1 class="headline-2">Search for "{{$searchstr}}"</h1>
        </div>
        <div class="row">
            @foreach ($results as $result)
                <div class="col-12">
                    <a href="{{$result->type==='WINE'?route('wine.show', ['wine' => $result->slug]):route('winery', ['winery' => $result->slug])}}">
                        {{$result->name}}
                    </a>
                </div>
            @endforeach

            {{ $results->links() }}
        </div>
    </div>
@endsection