<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/all.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <style>
        .copyright
        {
            width: 100%;
            background: #fafafa;
        }
        .copyright_container
        {
            width: 100%;
            height: 56px;
        }
        .copyright_content
        {
            font-size: 12px;
            color: rgba(0,0,0,0.6);
        }
        .copyright_content span
        {
            font-weight: 500;
        }
        .bg-image
        {
            background-image: url({{asset('storage/carousel/GroceriesPhoto.png')}});
            height: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            /*background-size: cover;*/
        }


    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('layout.login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('layout.register') }}</a>
                        </li>
                    @else

                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img class="mb-1 rounded-circle" src="{{asset(Auth::user()->avatar)}}" width="25px"> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile">{{ __('layout.profile') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('layout.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                        @if(Auth::user()->isadmin)
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="/admin">{{ __('layout.admin') }}</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="/cart"> {{ __('layout.cart') }} <span class="badge badge-info"> {{\App\Http\Controllers\CartController::getCartCount()}}</span></a>
                        </li>
                    @endguest
                    <li class="nav-item">
                        <a class="nav-link" href="/help">{{ __('profile.help') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong>{{strtoupper(\Illuminate\Support\Facades\App::getLocale())}}</strong>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/locale/lk">සිංහළ (LK)</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/locale/en">English (EN)</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="/items/search" method="GET">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="param" value="{{!isset($_GET['param']) ? '' : $_GET['param']}}">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">{{ __('layout.search') }}</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                        <div class="copyright_content">
                            Lanka Agri &copy; <script>document.write(new Date().getFullYear());</script>
                            All rights reserved | <a href="https://amodsachintha.github.io" target="_blank">amodsachintha</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
