<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pengelolaan Surat | @yield('title')</title>
        <link rel="icon" href="{{ asset('favicon.png') }}" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons-1.11.2/font/bootstrap-icons.min.css') }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <style>
            .max-vh-100 {height: 100vh;}
            .error-code {
                font-size: 130px;
                font-weight: bold;
                line-height: 95px;
            }
        </style>

    </head>
    <body class="antialiased">
        <div id="app" class="min-vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-5">
                        <div class="d-flex align-items-center gap-3 flex-column">
                        <h1 class="text-primary error-code mb-0">@yield('code')</h1>
                        <h4 class="fw-bold">@yield('message')</h4>
                        <a href="{{ route('index')}}" class="btn btn-lg btn-secondary">Back to home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
