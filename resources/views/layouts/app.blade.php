<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login | {{ config('app.name', 'Livewire ') }}</title>
    <script src="{{ asset('js/app.js') }}" ></script>
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/vendor/animate.css/animate.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
</head>
<body>
<x-alert-admin></x-alert-admin>
<x-success-admin></x-success-admin>
<main>
    @yield('content')
</main>
<script>
    $(window).on('load', function () {
        setTimeout(function () {
            $('#hideMeBack').fadeOut()
        }, 6000);
    });
</script>
</body>
</html>
