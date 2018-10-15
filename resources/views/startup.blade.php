@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row padding-row startup">
        <startup-form winery-name="{{$wineryName}}" />
    </div>

</div>
@endsection