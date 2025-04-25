<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- [Favicon] -->
    <link rel="icon" href="{{ asset('admin_assets/images/favicon.svg') }}" type="image/x-icon">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <link rel="stylesheet" href="{{ asset('admin_assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/fonts/material.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/style-preset.css') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Styles pushed from child views --}}
    @stack('styles')
</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- Pre-loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Sidebar -->
    @include('includes.sidebar')

    <!-- Header -->
    @include('includes.header')

    <!-- Main content -->
    <main class="pc-container">
        <div class="pc-content">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    @include('includes.footer')

    <!-- Page Specific JS -->
    <script src="{{ asset('admin_assets/js/plugins/apexcharts.min.js') }}"></script>

    <!-- Required JS -->
    <script src="{{ asset('admin_assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('admin_assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('admin_assets/js/plugins/feather.min.js') }}"></script>

    {{-- Scripts pushed from child views --}}
    @stack('scripts')
</body>
</html>
