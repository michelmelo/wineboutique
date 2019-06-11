@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row">
        <h1 class="headline-2">CUSTOMER SIGN UP</h1>
        <div class="col-lg-6 col-md-12 mobile-display">
            <img src="{{asset('img/customer-sign-up.png')}}">
        </div>

        <div class="col-lg-6 col-md-12 forms">
            <register-form />
        </div>
    </div>
</div>
@endsection
