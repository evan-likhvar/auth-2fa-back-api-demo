<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.7/dist/css/uikit.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.7/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.7/dist/js/uikit-icons.min.js"></script>

</head>
<body>
<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            <li class="uk-active"><a href="/laratrust/roles-assignment">LaraTrust</a></li>
            <li><a href="{{route('profile.2fa.activate.show')}}">2fa</a></li>
        </ul>

    </div>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li class="uk-active"><a href="#"> {{ Auth::user()->name }}</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
        </ul>
    </div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<div class="uk-section">
    <div class="uk-container">
        @yield('content')
    </div>
</div>

</body>
</html>
