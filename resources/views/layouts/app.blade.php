<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CMS') }}</title>

    <!-- Favicons -->
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }} ">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/icon.png') }} ">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href=" {{ asset('assets/css/plugins.css') }} ">
    <link rel="stylesheet" href=" {{ asset('assets/style.css') }} ">
    <!-- Cusom css -->
    <link rel="stylesheet" href=" {{ asset('assets/css/custom.css') }} ">

    <!-- Modernizer js -->
    <script src=" {{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }} "></script>

</head>
<body>
    <div id="app">
        <div class="wrapper" id="wrapper">
            @include('layouts.partials.navbar')
            <main>
                <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
                    <div class="container">
                        @include('layouts.partials.flash')
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts.partials.footer')
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- JS Files -->
	<script src="{{ asset('assets/js/plugins.js') }} "></script>
    <script src="{{ asset('assets/js/active.js') }} "></script>
    <script>
        $(function(){
            $('#alert_message').fadeTo(5000,500).slideUp(500,function(){
                $('#alert_message').slideUp(500);
            });
        });
    </script>
</body>
</html>
