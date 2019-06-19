@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row startup">
        <winery-edit-form winery-name="{{ $winery->name }}" winery-id="{{ $winery->id }}" winery-desc="{{ $winery->description }}" winery-profile="{{ $winery->profile }}" winery-cover="{{ $winery->cover }}" fetched-regions="{{json_encode($regions)}}" existing-shippings="{{json_encode($winery->winery_shippings)}}"/>
    </div>
</div>
@endsection