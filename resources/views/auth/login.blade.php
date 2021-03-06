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
                <input type="email" name="email" placeholder="Email" class="{{ $errors->has('email') ? 'invalid' : '' }}" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block error-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input type="password" name="password" class="{{ $errors->has('password') ? 'invalid' : '' }}" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block error-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <div class="d-block w-100 mt-1">
                    <span><a href="{{ route('password.request') }}">Forgot your password?</a></span>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="defaultCheck1">
                        Keep me signed in on this device
                    </label>
                </div>
                <input type="submit" name="submit" class="button red-button full-width" value="SIGN IN">
                <div class="other-login">
                    <div class="google-login regular">
                        <a href="{{route('register')}}">Create Account</a>
                    </div>
                    <div class="google-login  ">
                        <a href="{{url('/redirect/google')}}"><i class="fab fa-google mr-2"></i> Continue with Google </a>
                    </div>
                    
                    <div class="facebook-login ">
                        <a href="{{url('/redirect/facebook')}}"><i class="fab fa-facebook-f mr-2"></i> Continue with Facebook</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
