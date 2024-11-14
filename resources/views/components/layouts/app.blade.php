<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>

    <link rel="shortcut icon" href="{{ asset('logo.webp') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('logo.webp') }}" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.45.1/dist/apexcharts.css">

    <link rel="shortcut icon" href="{{ asset('logo.webp') }}" type="image/x-icon">

    <link rel="stylesheet" crossorigin href="{{ asset('dist/assets/compiled/css/app.css') }}">
    {{-- <link rel="stylesheet" crossorigin href="{{ asset('dist/assets/compiled/css/app-dark.css') }}"> --}}
    <link rel="stylesheet" crossorigin href="{{ asset('dist/assets/compiled/css/iconly.css') }}">

    @livewireStyles
</head>

<body>
    {{-- <script src="{{ asset('dist/assets/static/js/initTheme.js') }}"></script> --}}
    <div id="app">

        @include('components.layouts.partials.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>{{ $title ?? 'Page Title' }}</h3>
            </div>
            <div class="page-content">
                {{ $slot }}
            </div>

            {{-- @include('components.layouts.partials.footer') --}}

            
            <!-- Include ApexCharts library -->
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            
            <!-- Livewire Charts Scripts -->
            
            <!-- Livewire Scripts -->
            @livewireScripts
            @livewireChartsScripts
        </div>
    </div>

    {{-- <script src="{{ asset('dist/assets/static/js/components/dark.js') }}"></script> --}}
    <script src="{{ asset('dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/compiled/js/app.js') }}"></script>

    <!-- Need: Apexcharts -->
    {{-- <script src="assets/extensions/apexcharts/apexcharts.min.js"></script> --}}
    <script src="assets/static/js/pages/dashboard.js"></script>
    
</body>

</html>
