@props(['files', 'post'])
<div class="mt-4 rounded-lg bg-gray-200 p-3 dark:bg-gray-800">
    <div class="mb-3 flex items-center justify-between">
        <h3 class="text-lg font-semibold">Fichiers joints ({{ $files->count() }})</h3>
        @if ($files->count() > 3)
            <a href="{{ route('posts.show', $post) }}" class="hover:text-vintageRed-default hover:underline">Voir tout</a>
        @endif
    </div>
    <ul class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($files->take(3) as $file)
            <div
                class="flex flex-col items-start justify-between gap-3 rounded-lg bg-white p-3 shadow-sm dark:bg-gray-700 md:flex-row">
                <div class="w-full max-w-36 gap-3">
                    <div class="break-words text-sm font-medium">
                        {{ $file->name }}
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">
                        @if ($file->size)
                            {{ number_format($file->size / 1024, 2) }} KB
                        @else
                            Taille inconnue
                        @endif
                    </div>
                </div>
                <a href="{{ $file->url }}"
                    class="mt-auto rounded-lg bg-vintageRed-default p-2 text-classic-white hover:bg-vintageRed-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>

                </a>
            </div>
        @endforeach
    </ul>
</div>
