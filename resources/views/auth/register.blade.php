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
                <input type="text" name="firstName" placeholder="First Name" required value="{{ old('firstName') ? old('firstName') : '' }}">
                @if ($errors->has('firstName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstName') }}</strong>
                    </span>
                @endif
                <input type="text" name="lastName" placeholder="Last Name" required value="{{ old('lastName') ? old('lastName') : '' }}">
                @if ($errors->has('lastName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastName') }}</strong>
                    </span>
                @endif
                <input type="email" name="email" placeholder="Email" required value="{{ old('email') ? old('email') : '' }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input type="password" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="acceptTerms" id="defaultCheck1" required>
                    <label class="form-check-label" for="defaultCheck1">
                        I agree to <a href="#">Terms and Conditions</a> of the Wine Boutique*
                    </label>
                </div>
                @if ($errors->has('acceptTerms'))
                    <span class="help-block">
                        <strong>{{ $errors->first('acceptTerms') }}</strong>
                    </span>
                @endif
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="acceptAge" id="defaultCheck2" required>
                    <label class="form-check-label" for="defaultCheck2">
                        I am at least 21 years of age.*
                    </label>
                </div>
                @if ($errors->has('acceptAge'))
                    <span class="help-block">
                        <strong>{{ $errors->first('acceptAge') }}</strong>
                    </span>
                @endif

                <div id="over-21" class="d-none">
                    <input type="date" name="birthday" max="{{ date("Y-m-d", strtotime("-21 year", time())) }}" />
                </div>

                <input type="submit" name="submit" class="button red-button full-width" value="CREATE AN ACCOUNT">
            </form>
        </div>
    </div>

</div>
@endsection
