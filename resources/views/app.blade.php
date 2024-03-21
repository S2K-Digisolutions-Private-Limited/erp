<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Fetch project name dynamically -->
    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- @vite('resources/js/app.js') --}}
    <link href="{{ asset('build/assets/app-Bq_tc4jC.css') }}" rel="stylesheet">
    @inertiaHead
    @php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
    @endphp
    <link
        href="{{ asset('build/' . $manifest['node_modules/@mdi/font/fonts/materialdesignicons-webfont.eot']['file']) }}"
        rel="stylesheet">
    <link
        href="{{ asset('build/' . $manifest['node_modules/@mdi/font/fonts/materialdesignicons-webfont.ttf']['file']) }}"
        rel="stylesheet">
    <link
        href="{{ asset('build/' . $manifest['node_modules/@mdi/font/fonts/materialdesignicons-webfont.woff']['file']) }}"
        rel="stylesheet">
    <link
        href="{{ asset('build/' . $manifest['node_modules/@mdi/font/fonts/materialdesignicons-webfont.woff2']['file']) }}"
        rel="stylesheet">


</head>

<body class="font-sans antialiased">
    @routes
    @inertia
    <script src="{{ asset('build/assets/app-BbLAZk9T.js') }}" defer></script>
</body>

</html>
