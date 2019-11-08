@extends('layouts.app')

@section('content')
<div class="container customer">
    <div class="row padding-row">
        <h1 class="headline-2">CUSTOMER SIGN UP</h1>
        <div class="col-lg-6 col-md-12 mobile-display">
            <img src="{{asset('img/customer-sign-up.png')}}">
        </div>

        <div class="col-lg-6 col-md-12 forms">
            <register-form />
        </div>

        <div class="other-login col-md-6 col-md-push-6">
            <div class="google-login">
                <a href="{{url('/redirect/google')}}">Register with Google</a>
            </div>
            <div class="facebook-login">
                <a href="{{url('/redirect/facebook')}}">Register with Facebook</a>
            </div>
        </div>
    </div>
</div>
@endsection
