<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <header-component :resources="{{ \App\Models\ResourceType::all() }}" :logged-in="{{ !\Illuminate\Support\Facades\Auth::guest() ? 'true' : 'false' }}"></header-component>
    @yield('banner-image')
    @include('frontend._partials.nav')
    @yield('content')
</div>
	@yield('scripts')
</body>
</html>
