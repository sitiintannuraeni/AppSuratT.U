<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head><!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons-1.11.2/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    @stack('css')
</head>
<body class="overflow-y-auto">
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper">
                <div class="sidebar-header">
                    <a href="#">
                        Pengelolaan Surat
                    </a>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="/" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @if(Auth::user()->role == "guru")
                            <li class="sidebar-item">
                                <a href="{{ route('data-surat-guru.index') }}" class="sidebar-link">
                                    <i class="bi bi-file-earmark-arrow-up-fill"></i>
                                    <span>Data Surat Masuk</span>
                                </a>
                            </li>
                        @else
                            <li class="sidebar-item has-sub">
                                <a href="#collapseUsers" class="sidebar-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseUsers">
                                    <i class="bi bi-people-fill"></i>
                                    <span>Users</span>
                                </a>
                                <ul class="collapse submenu" id="collapseUsers">
                                    <li class="submenu-item ">
                                        <a href="{{ route('staff-tata-usaha.index') }}">Data Staff</a>
                                    </li>

                                    <li class="submenu-item ">
                                        <a href="{{ route('data-guru.index') }}">Data Guru</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item has-sub">
                                <a href="#collapseLetters" class="sidebar-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseLetters">
                                    <i class="bi bi-file-earmark-post"></i>
                                    <span>Data Surat</span>
                                </a>
                                <ul class="collapse submenu" id="collapseLetters">
                                    <li class="submenu-item ">
                                        <a href="/klasifikasi-surat">Data Klasifikasi Surat</a>
                                    </li>

                                    <li class="submenu-item ">
                                        <a href="{{ route('data-surat.index') }}">Data Surat</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div id="main" class="layout-navbar navbar-fixed">
            <header>
                <nav class="main-navbar navbar navbar-expand navbar-top sticky-top bg-white">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block d-xl-none">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                    <div class="user-menu d-flex align-items-center">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 fw-semibold">{{ Auth::user()->name }}</h6>
                                            <p class="mb-0 text-sm text-muted">{{ Auth::user()->role }}</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <i class="bi bi-person-circle fs-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="icon-mid bi bi-box-arrow-in-right me-2"></i> {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @stack('js')
</body>
</html>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pengelolaan Surat') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons-1.11.2/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @stack('css')

    <style>
        .max-vh-100 {height: 100vh;}
        .pt56 {padding-top: 56px}
        .pt68 {padding-top: 68px}
        body {background: #f4f4f4}
    </style>
</head>
<body>
    <div id="app" class="min-vh-100">
        <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Pengelolaan Surat
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if(Auth::check())
            <main class="container-fluid min-vh-100">
                <div class="row flex-nowrap">
                    <!-- Sidebar Menu -->
                    <div class="col-md-3 px-0">
                        <div class="card border-0 bg-white rounded-0 min-vh-100 pt56 shadow-sm">
                            <div class="card-body rounded-0">
                                <ul class="nav nav-pills flex-column mb-auto">
                                    <li class="nav-item">
                                        <a href="/" class="nav-link link-dark" aria-current="page">
                                            <i class="bi bi-grid-fill"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    @if(Auth::check())
                                        @if(Auth::user()->role == "guru")
                                            <li class="nav-item">
                                                <a href="{{ route('data-surat-guru.index') }}" class="nav-link link-dark" aria-current="page">
                                                    <i class="bi bi-postcard-fill"></i>
                                                    Data Surat Masuk
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="#" class="nav-link link-dark" data-bs-toggle="collapse" data-bs-target="#users-collapse" aria-expanded="true">
                                                    <i class="bi bi-people-fill"></i>
                                                    Users
                                                </a>

                                                <div class="collapse" id="users-collapse" style="">
                                                    <ul class="btn-toggle-nav pb-1 small list-unstyled">
                                                        <li><a href="{{ route('staff-tata-usaha.index') }}" class="nav-link link-dark rounded">Data Staff Tata Usaha</a></li>
                                                        <li><a href="{{ route('data-guru.index') }}" class="nav-link link-dark rounded">Data Guru</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#" class="nav-link link-dark" data-bs-toggle="collapse" data-bs-target="#letter-collapse" aria-expanded="true">
                                                    <i class="bi bi-postcard-fill"></i>
                                                    Data Surat
                                                </a>

                                                <div class="collapse" id="letter-collapse" style="">
                                                    <ul class="btn-toggle-nav pb-1 small list-unstyled">
                                                        <li><a href="/klasifikasi-surat" class="nav-link link-dark rounded">Data Klasifikasi Surat</a></li>
                                                        <li><a href="{{ route('data-surat.index') }}" class="nav-link link-dark rounded">Data Surat</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Sidebar Menu -->

                    <!-- Main Body -->
                    <div class="col-lg-9 px-0">
                        <div class="min-vh-100 max-vh-100 pt68 overflow-y-auto px-3 pb-3">
                            @yield('content')
                        </div>
                    </div>
                    <!-- End Main Body -->
                </div>
            </main>
        @endif
    </div>

    <script src="{{ mix('js/app.js') }}"></script>

    @stack('js')
</body>
</html>
