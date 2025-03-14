@props(['files'])

<div class="mt-4 rounded-lg bg-gray-100 p-3 dark:bg-gray-800">
    <h3 class="mb-3 text-lg font-semibold">📂 Fichiers joints</h3>
    <ul class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($files as $file)
            <li class="flex items-center justify-between rounded-lg bg-white p-3 shadow-sm dark:bg-gray-700">
                <div class="flex items-center gap-3">
                    <!-- Icône du fichier -->
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-600">
                        <i data-feather="file"></i>
                    </div>
                    <!-- Nom et taille du fichier -->
                    <div>
                        <p class="text-sm font-medium">
                            {{ $file->name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            @if ($file->size)
                                {{ number_format($file->size / 1024, 2) }} KB
                            @else
                                Taille inconnue
                            @endif
                        </p>
                    </div>
                </div>
                <!-- Bouton de téléchargement -->
                <a href="{{ $file->url }}" download
                    class="rounded-lg bg-vintageRed-default px-3 py-1.5 text-sm font-medium text-white hover:bg-vintageRed-dark">
                    <i data-feather="download"></i>
                </a>
            </li>
        @endforeach
    </ul>
</div>
