@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row startup">
        <winery-edit-form winery-name="{{ $winery->name }}" winery-id="{{ $winery->id }}" winery-desc="{{ $winery->desc }}" winery-profile="{{ $winery->profile }}" winery-cover="{{ $winery->cover }}"/>
    </div>
</div>
@endsection