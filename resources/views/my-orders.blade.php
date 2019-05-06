@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row padding-row">

        @include('layouts.partials._profile_menu')

        <div class="col-md-8 col-sm-12">
            <div>
            <my-order-form user-orders="{{json_encode($orders)}}"/>
            </div>
        </div>

    </div>
</div>
@endsection