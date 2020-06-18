<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>

<!-- jQuery -->
<script src="{{ asset('frontend/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

<!-- Scripts -->
<script src="{{ asset('frontend/js/script.js') }}" type="text/javascript"></script>


@yield('extra-css')
<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">

<!-- desoSlide styles -->
<link href="{{ asset('desoslide/css/jquery.desoslide.min.css') }}" rel="stylesheet">
<link href="{{ asset('desoslide/css/animate.min.css') }}" rel="stylesheet">

<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.ico') }}">
<link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('frontend/fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">
<link href="{{ asset('frontend/css/ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet" media="only screen and (max-width: 1200px)" />
