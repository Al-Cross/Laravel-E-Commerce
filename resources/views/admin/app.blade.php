<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/fontawesome/css/all.min.css') }}"/>
</head>
<body class="app sidebar-mini rtl">
    @include('admin.partials.sidebar')
    <main class="app-content">
        <div id="app">
            @include('admin.partials.header')
            @include('flash::message')
            @yield('content')

            <flash message="{{ session('flash') }}"></flash>
        </div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </main>
    <script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/pace.min.js') }}"></script>
</body>
</html>
