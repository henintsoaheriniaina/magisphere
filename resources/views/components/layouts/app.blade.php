@props(['title' => 'Magisphère'])
<!DOCTYPE html>
<html lang="fr"
    class="{{ auth()->check() ? auth()->user()->theme : (request()->cookie('theme', 'light') === 'dark' ? 'dark' : '') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title !== 'Magisphère' ? $title . ' | Magisphère' : 'Magisphère' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-classic-white text-classic-black dark:bg-classic-black dark:text-classic-white">
    <x-header />
    <main class="default-container">
        {{ $slot }}
    </main>
    <x-footer />
    @livewireScripts
</body>

</html>
