@props(['title' => 'Magisphère'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title !== 'Magisphère' ? $title . ' | Magisphère' : 'Magisphère' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Styles / Scripts -->
    {{-- @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))) --}}
    {{-- @endif --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-classic-white text-classic-black dark:bg-classic-black dark:text-classic-white">
    <x-header />
    <main class="default-container">
        {{ $slot }}
    </main>
    <x-footer />
</body>

</html>
