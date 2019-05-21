@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row padding-row startup">
        <startup-form winery-name="{{$wineryName}}" winery-id="{{$wineryId}}" winery-desc="{{$winery_desc}}" winery-profile="{{$winery_profile}}" winery-cover="{{$winery_cover}}" selected-regions="{{json_encode($winery_regions)}}" fetched-regions="{{json_encode($regions)}}"/>
    </div>

</div>
@endsection