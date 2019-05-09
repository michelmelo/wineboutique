@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row padding-row startup">
        <winery-edit-form winery-name="{{ $winery_name }}" winery-id="{{ $winery_id }}" winery-desc="{{ $winery_desc }}" winery-profile="{{ $winery_profile }}" winery-cover="{{ $winery_cover }}"/>
    </div>

</div>
@endsection