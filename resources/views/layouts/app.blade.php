<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CMS Museum') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    @stack('styles')

    <link rel="stylesheet" href="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main" class='layout-navbar'>
            <div id="main-content">
                @include('layouts.navbar')
                @include('layouts.alert')
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
    </div>

    {{-- Perfect Scrollbar --}}
    <script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}" defer></script>
    {{-- Bootstrap --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>

    @stack('scripts')

    {{-- Template Custom Main --}}
    <script src="{{ asset('js/main.js') }}" defer></script>

</body>

</html>
