<!DOCTYPE html>
<html>
<head>
	<title>Wine Boutique</title>	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />

	<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

    
    <!-- Scripts -->

    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
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
	</div>
	
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/load-more.js') }}"></script>
    @yield('script')
</body>
</html>