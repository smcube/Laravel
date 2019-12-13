<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Podcast Publisher') }}</title>

    <!-- Scripts -->
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/bulma.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item has-text-weight-light has-text-grey" href="/">
            {{ config('app.name', 'Podcast Publisher') }}
        </a>
    </div>
    <div class="navbar-menu is-active">
        <div class="navbar-start">
            @auth
                <a class="navbar-item @if(Route::is('podcasts.*')) has-text-weight-bold @endif"
                   href="{{ route('podcasts.index') }}">@lang('common.podcasts')</a>
                <a class="navbar-item @if(Route::is('episodes.*')) has-text-weight-bold @endif"
                   href="{{ route('episodes.index') }}">@lang('common.episodes')</a>
            @endauth
        </div>
        <div class="navbar-end">
            <!-- Authentication Links -->
            @guest
                <a class="navbar-item" href="{{ route('login') }}">@lang('nav.login')</a>
                @if (Route::has('register'))
                    <a class="navbar-item" href="{{ route('register') }}">@lang('nav.register')</a>
                @endif
            @else
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="{{ route('settings.edit') }}">
                            @lang('nav.settings')
                        </a>
                        <a class="navbar-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            @lang('nav.logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>

<section class="section">

    @if (session('success'))
        <div class="notification is-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="notification is-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</section>
</body>
</html>
