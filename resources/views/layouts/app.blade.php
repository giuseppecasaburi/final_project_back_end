<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="/storage/site_image/favicon-32x32.png" />
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js', 'resources/scss/app.scss', 'resources/css/dark_theme.css'])

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm ms-nav-bar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/storage/site_image/logo.png" alt="Logo" style="height: 40px; width: auto;">
                </a>

                @if (request()->is('login') || request()->is('register'))
                    <ul
                        class="navbar-nav {{ request()->is('login') || request()->is('register') ? 'auth-nav' : 'ms-auto my-2 my-lg-0' }} ">
                        <li class="nav-item {{ request()->is('login') ? 'd-none d-sm-block' : '' }}">
                            <a class="nav-link" href="{{ route('login') }}">Accedi</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item {{ request()->is('register') ? 'd-none d-sm-block' : '' }}">
                                <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                            </li>
                        @endif
                    </ul>
                @else
                    <!-- Toggler/collapsibe Button -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navbar links -->
                    <div class="collapse navbar-collapse" id="navbarContent">
                        <!-- Left Side -->
                        <ul class="navbar-nav me-5 mb-2 mb-lg-0 left-side">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/movies') }}">Film</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/directors') }}">Registi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/genre') }}">Generi</a>
                            </li>
                        </ul>
                        <div class="search-bar">
                            <form action="{{ route('search') }}" class="d-flex m-0" role="search" method="GET">
                                <input class="form-control me-3" name="query_search"
                                    value="{{ request('query_search') }}" type="search"
                                    placeholder="Nome Film o Regista.." aria-label="Search" required />
                                <button class="btn btn-outline-warning" type="submit">Cerca</button>
                            </form>
                        </div>
                        <!-- Right Side -->
                        <ul
                            class="navbar-nav {{ request()->is('login') || request()->is('register') ? 'auth-nav' : 'ms-auto my-2 my-lg-0' }} ">
                            @guest
                                <li class="nav-item {{ request()->is('login') ? 'd-none d-sm-block' : '' }}">
                                    <a class="nav-link" href="{{ route('login') }}">Accedi</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item {{ request()->is('register') ? 'd-none d-sm-block' : '' }}">
                                        <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ url('/') }}">Bacheca</a></li>
                                        <li><a class="dropdown-item" href="{{ url('profile') }}">Profilo</a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Disconnettiti
                                            </a>
                                        </li>
                                    </ul>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                @endif
            </div>
        </nav>
    </div>

    <main class="">
        @yield('content')
    </main>

    @yield('script')
</body>

</html>
