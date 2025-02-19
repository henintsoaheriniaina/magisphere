@props(['title' => 'Magisphère'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title !== 'Magisphère' ? $title . ' | Magisphère' : 'Magisphère' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-classic-white text-classic-black dark:bg-classic-black dark:text-classic-white">
    <x-header />

    <main class="default-container">
        {{ $slot }}
    </main>

    <x-footer />
</body>

</html>
