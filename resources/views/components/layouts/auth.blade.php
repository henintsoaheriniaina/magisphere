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
</head>

<body class="bg-classic-white text-classic-black dark:bg-classic-black dark:text-classic-white">
    <div
        class="mx-auto mt-10 flex min-h-screen max-w-4xl flex-col justify-center gap-10 px-6 py-6 sm:px-10 md:gap-20 lg:px-12">
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
