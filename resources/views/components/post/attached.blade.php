@props(['files'])

<div class="mt-4 rounded-lg bg-gray-200 p-3 dark:bg-gray-800">
    <h3 class="mb-3 text-lg font-semibold">Fichiers joints</h3>

    <ul class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($files as $file)
            <div
                class="flex flex-col items-start justify-between gap-3 rounded-lg bg-white p-3 shadow-sm dark:bg-gray-700 md:flex-row">
                <div class="w-full gap-3">
                    <!-- Nom et taille du fichier -->
                    <div class="text-sm font-medium">
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
                    class="mt-auto flex items-center rounded-lg bg-vintageRed-default p-2 text-white hover:bg-vintageRed-dark">
                    <i data-feather="download"></i>
                </a>
            </div>
        @endforeach
    </ul>
</div>
