<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pengelolaan Surat | @yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

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
                    <a href="#" class="close-menu-mobile">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="/" class="sidebar-link">
                                <i class="bi bi-grid-fill text-primary"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @if(Auth::user()->role == "guru")
                            <li class="sidebar-item">
                                <a href="{{ route('data-surat-guru.index') }}" class="sidebar-link">
                                    <i class="bi bi-newspaper text-primary"></i>
                                    <span>Data Surat Masuk</span>
                                </a>
                            </li>
                        @else
                            <li class="sidebar-item has-sub">
                                <a href="#collapseUsers" class="sidebar-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseUsers">
                                    <i class="bi bi-people-fill text-primary"></i>
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
                                    <i class="bi bi-newspaper text-primary"></i>
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
                <nav class="main-navbar navbar navbar-expand navbar-top bg-white">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block d-xl-none">
                            <i class="bi bi-justify fs-3 text-primary"></i>
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
                                                <i class="bi bi-person-circle fs-2 text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="icon-mid bi bi-box-arrow-in-right me-2 text-primary"></i> {{ __('Logout') }}
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

    <script>
        $(".burger-btn").on("click", function (e) {
          e.preventDefault();
          const app = $("#app");
          if(app.find('.sidebar-wrapper').hasClass('show')) {
	          app.removeClass('overlay');
	          app.find('.sidebar-wrapper').removeClass('show')
          } else {
	          app.addClass('overlay');
	          app.find('.sidebar-wrapper').addClass('show')
          }
        })

        $(".close-menu-mobile").on("click", function (e) {
          e.preventDefault();
          $(".burger-btn").trigger('click');
        })
    </script>
    @stack('js')
</body>
</html>
