@props(['title' => 'Magisphère'])
<!DOCTYPE html>
<html lang="fr" class="dark">

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
</head>

<body class="bg-classic-white text-classic-black dark:bg-classic-black dark:text-classic-white">
    <div
        class="mx-auto mt-10 flex min-h-[90vh] max-w-4xl flex-col justify-center gap-10 px-6 py-6 sm:px-10 md:gap-20 lg:px-12">
        {{ $slot }}
    </div>
</body>

</html>
