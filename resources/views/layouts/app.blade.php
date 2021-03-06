<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.png')}}"/>

    @include('layouts.partials._seo')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
{{--    <style src="vue-multiselect/dist/vue-multiselect.min.css"></style>--}}
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

	<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://js.stripe.com/v3/"></script>

    <!-- Scripts -->

{{--    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>--}}
    @if(strpos(url()->current(), '/register/sell') !== false)
    <script src="https://www.google.com/recaptcha/api.js?render=6LdXLbIZAAAAALeKEq0GDN8Oea1B-dWf3Tg21BH1">
    @endif
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
		window.App = {!! json_encode([
            'baseUrl' => config('app.url')
        ]) !!};
    </script>
</head>
<body>
    @include('layouts.partials._header')
	<div class="main" id="app">
        @yield('content')
        @include('layouts.partials._footer')
        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->type === \App\User::$types['seller'])
            <report-bug-form />
        @endif
	</div>

    <div class="default-popup is-visible popup-holder" role="alert" style="display:none;">
        <div class="popup-container">
            <div class="popup-head text-center">
                <h2 class="thank-you">Are you sure you wish to delete <span id="wine-name-holder"></span>?</h2>
            </div>
            <div class="popup-body text-center">
                <span href="#" id="delete-wine-confirm" class="button red-button"><i class="fas fa-times"></i> Yes</span>
                <span href="#" id="close-popup" class="button red-button"><i class="fas fa-times"></i> No</span>
            </div>
        </div>
    </div>

    <!-- Scripts -->
{{--    @if(request()->route()->getName() !== 'my-payments.show')--}}
        <script src="{{ asset('js/app.js') }}"></script>
    {{--@endif--}}

    <script src="{{ asset('js/load-more.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('script')
</body>
</html>
