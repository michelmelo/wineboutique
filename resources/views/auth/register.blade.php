@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row padding-row">
        <h1 class="headline-2">CUSTOMER SIGN UP</h1>
        <div class="col-lg-6 col-md-12 mobile-display">
            <img src="{{asset('img/customer-sign-up.png')}}">
        </div>

        <div class="col-lg-6 col-md-12 forms">
            <form class="form-inline" method="post" action="{{route('register')}}">
                @csrf
                <input type="hidden" name="type" value="CUSTOMER">
                <input type="text" name="firstName" placeholder="First Name">
                <input type="text" name="lastName" placeholder="Last Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="acceptTerms" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        I agree to <a href="#">Terms and Conditions</a> of the Wine Boutique*
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="acceptAge" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                        I am at least 21 years of age.*
                    </label>
                </div>
                <input type="submit" name="submit" class="button red-button full-width" value="CREATE AN ACCOUNT">
            </form>
        </div>
    </div>

</div>
@endsection
