<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <!-- Tabler Core -->
        <link rel="stylesheet" href="{{ asset('cpanel/vendor/css/tabler.min.css') }}">
        <!-- Tabler Plugins -->
        <link rel="stylesheet" href="{{ asset('cpanel/vendor/css/tabler-buttons.min.css') }}">
        <style>
            body {
                display: none;
            }
        </style>

        <!-- Scripts -->
        @routes
        <script src="{{ mix('cpanel/js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        @inertia
        <!-- Libs JS -->
        <script src="{{ asset('cpanel/vendor/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('cpanel/vendor/libs/jquery/dist/jquery.slim.min.js') }}"></script>
        <!-- Tabler Core -->
        <script src="{{ asset('cpanel/vendor/js/tabler.min.js') }}"></script>
        <script>
            document.body.style.display = "block"
        </script>
    </body>
</html>
