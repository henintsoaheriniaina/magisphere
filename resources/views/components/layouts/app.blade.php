@props(['title' => 'Magisphère'])
<!DOCTYPE html>
<html lang="fr" class="{{ auth()->check() ? auth()->user()->theme : 'dark' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title !== 'Magisphère' ? $title . ' | Magisphère' : 'Magisphère' }}</title>
    @if (app()->environment('local'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
        <script src="{{ asset('build/assets/app.js') }}" defer></script>
    @endif
    @livewireStyles
</head>

<body class="bg-classic-white text-classic-black dark:bg-classic-black dark:text-classic-white">
    <x-header />
    <main class="default-container">
        {{ $slot }}
    </main>
    @livewireScripts
</body>

</html>
