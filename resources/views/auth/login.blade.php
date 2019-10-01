@extends('layouts.app')

@section('content')
<div class="container customer">
    
    <div class="row padding-row">
        <h1 class="headline-2">SIGN IN</h1>
        <div class="col-lg-6 col-md-12 mobile-display">
            <img src="{{asset('img/sign-in.png')}}">
        </div>

        <div class="col-lg-6 col-md-12 forms">
            <form class="form-inline" method="post">
                @csrf
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input type="password" name="password" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <span><a href="{{ route('password.request') }}">Forgot your password?</a></span>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="defaultCheck1">
                        Keep me signed in on this device
                    </label>
                </div>
                <input type="submit" name="submit" class="button red-button full-width" value="SIGN IN">
                <div class="other-login">
                    <div class="google-login">
                        <a href="{{url('/redirect/google')}}">Login in with Google</a>
                    </div>
                    <div class="google-login">
                        <a href="{{route('register')}}">Create Account</a>
                    </div>
                    <div class="facebook-login">
                        <a href="{{url('/redirect/facebook')}}">Login in with Facebook</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
