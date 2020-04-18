<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Quizflare') }} | @yield("title")
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/body.css') }}" rel="stylesheet">

    <!-- Additional links if desired -->
    @yield('links')

    <!-- Web app brand icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.svg') }}" />

</head>
<body>
    <div id="app">
        <nav id="globalNavbar" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div id="mainNavbarContainer" class="">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img id="webAppLogo" src="{{ asset('images/logo.svg') }}" class="svg-logo" alt="Quizshare Logo">
                </a>

                <a class="navbar-brand" id="navbarTextBrand" href="{{ route('home') }}">
                    {{ config('app.name', 'Quizflare') }}
                </a>

                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <input class="form-control glow" id="navSearchbar" type="search" placeholder="{{ __('Search the website...') }}" aria-label="Search">
                        </li>
                        <li>
                            <a class="nav-link {{ Request::path() === 'home' ? 'current-page' : '' }}" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li>
                            <a class="nav-link {{ Request::path() === 'quiz' ? 'current-page' : '' }}" href="{{ route('quiz') }}">{{ __('Explore') }}</a>
                        </li>
                        @if(Auth::user()->is_admin)
                        <li>
                            <a class="nav-link {{ Request::path() === 'quiz/create' ? 'current-page' : '' }}" href="{{ route('quizCreate') }}">{{ __('Create a quiz') }}</a>
                        </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if(route('login') === URL::current())
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link page-auth"
                                           href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="nav-link page-auth"
                                       href="{{ route('login') }}">{{ __('Sign In') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" style="right: 0; left: auto" aria-labelledby="navbarDropdown">

                                    @if(Auth::user()->is_admin == 1)
                                        <a class="dropdown-item" href="{{ route('quizCreate') }}">
                                            {{ __('Create a quiz') }}
                                        </a>
                                    @endif

                                    @if(!Auth::guest())
                                        <a class="dropdown-item" href="{{ route('profileShow') }}">
                                            Profil
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sign Out') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}"
                                          method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        <!-- Localization caret -->
{{--                        <li id="langCaret" class="nav-item dropdown">--}}
{{--                            <p class="sep">|</p>--}}

{{--                            <div class="dropdown langDropdown">--}}

{{--                                <button class="btn btn-default dropdown-toggle" type="button" id="langDropDown"--}}
{{--                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">--}}
{{--                                    <img src="{{ asset('images/icons/world.svg') }}" alt="" id="worldGlyph">--}}
{{--                                    <p id="langIndicator">{{ strtoupper(app()->getLocale()) }}</p>--}}
{{--                                    <span class="caret"></span>--}}
{{--                                </button>--}}

{{--                                <ul class="dropdown-menu" id="langDropDownContent" aria-labelledby="dropdownMenu1">--}}
{{--                                    @foreach(config('app.locales') as $cult => $loc)--}}
{{--                                        <li class="dropdown-item">--}}
{{--                                            <img src="{{ asset("images/country_flags/".$cult.".svg") }}"--}}
{{--                                                 class="loc-flag" alt="{{ $loc }} flag">--}}
{{--                                            <a class="lang-item nav-link"--}}
{{--                                               href="{{ route('home', $cult) }}">{{ $loc }}</a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}

{{--                            </div>--}}
{{--                        </li>--}}
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            @yield("content")

            <footer>
                <div class="container py-4">
                    <hr class="mx-5">
                    <p>© 2020 {{ config("app.name") }} Inc.</p>
                    <hr class="mx-5">
                </div>
            </footer>
        </main>

        <info-modal>
            @yield("tutos")
        </info-modal>
    </div>

    {{ Request::path() }}
    @yield("scripts")

</body>
</html>
