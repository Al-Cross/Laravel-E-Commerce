<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- jQuery -->
    <script src="{{ asset('frontend/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

    <!-- Bootstrap files-->
    {{-- <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script> --}}


    <!-- Scripts -->
    <script src="{{ asset('frontend/js/script.js') }}" type="text/javascript"></script>

    @yield('extra-css')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.ico') }}">
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('frontend/plugins/owlcarousel/assets/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/plugins/owlcarousel/assets/owl.theme.default.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet" media="only screen and (max-width: 1200px)" />
    <link href="{{ asset('frontend/plugins/slickslider/slick.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/plugins/slickslider/slick-theme.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="app">
        @include('partials.header')
        @include('flash::message')

        <main class="py-4">
            @yield('content')
        </main>

        <flash message="{{ session('flash') }}"></flash>

        @include('partials.footer')
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    @yield ('scripts')
    <script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
</body>
</html>
