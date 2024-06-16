<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{-- Developed by Mcomps Limited | www.mcomps.africa | +254700106541 --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/flags/flags.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @livewireStyles
</head>

<body>

    <div class="main-wrapper">

        @livewire('elements.header')
        @livewire('elements.sidebar')
        <div class="page-wrapper">
        {{ $slot }}
        @livewire('elements.footer')
        </div>

        <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('assets/js/feather.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>

        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="https://cdn.tiny.cloud/1/pdov4xcmnreq2uxhpc4xszzus9qtsp88oke8twqeh6d55zmx/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
        @livewireScripts
</body>

{{-- Developed by Mcomps Limited | www.mcomps.africa | +254700106541 --}}

</html>
