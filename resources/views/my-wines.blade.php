@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row padding-row">
            <h1 class="headline-2">MY WINES</h1>
        </div>
        <div class="row">
            <my-wines-form :current-wines="{{json_encode($wines)}}" />
        </div>
    </div>
@endsection