<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials._head')
</head>
<body>
    <div id="app">
        @include('partials.header')
        @include('flash::message')

        <main>
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
