@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row padding-row">
        <h1 class="headline-2">SIGN UP TO SELL</h1>
        <div class="col-lg-6 col-md-12 mobile-display">
            <img src="{{asset('img/sign-up-to-sell.png')}}">
        </div>

        <div class="col-lg-6 col-md-12 forms">
            <register-sell-form />
        </div>
    </div>

</div>

@endsection
