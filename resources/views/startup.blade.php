@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row padding-row startup">
        <startup-form winery-name="{{$winery->name}}" winery-id="{{$winery->id}}" winery-desc="{{$winery->description}}" winery-profile="{{$winery->profile}}" winery-cover="{{$winery->cover}}" selected-regions="{{json_encode($winery_regions)}}" fetched-regions="{{json_encode($regions)}}"/>
    </div>

</div>
@endsection