<!doctype html>
<html lang="{{ str_replace('_', '-') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard | {{ config('app.name', 'Livewire ') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
</head>
<script src="{{ asset('js/app.js') }}" defer></script>

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
