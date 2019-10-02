@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row justify-content-center mb-5">
        <div class="col-12 text-center">
            <h1 class="headline-2 text-uppercase" >{{ __('Reset Password') }}</h1>

            <div class="py-4">
                @if (session('status'))
                    <div class="alert alert-light help-block" role="alert">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row mb-3 forms">
                        <div class="col-12 col-md-6 mx-auto">
                            <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-12">
                            <button type="submit" class="button red-button margin-0-auto margin-t">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
