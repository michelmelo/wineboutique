<!DOCTYPE html>
<html>
<head>
	<title>Wine Boutique</title>	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<!-- Scripts -->
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
	</div>
    @include('layouts.partials._footer')
	
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>