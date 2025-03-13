@props(['post'])

<div class="rounded-lg border border-classic-black p-4 shadow-lg dark:border-classic-white">

    <!-- Header du post -->
    <div class="flex items-center space-x-3">
        <img src="{{ $post->user->image_url ?? asset('images/users/avatar.png') }}" alt="Avatar"
            class="h-10 w-10 rounded-full">
        <div>
            <h3 class="font-semibold text-classic-black dark:text-classic-white">{{ $post->user->firstname }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <!-- Description -->
    <p class="mt-3 text-classic-black dark:text-classic-white">{{ $post->description }}</p>

    @php
        $imagesAndVideos = $post->medias->filter(fn($file) => Str::contains($file->type, ['image', 'video']));
        $otherFiles = $post->medias->reject(fn($file) => Str::contains($file->type, ['image', 'video']));
    @endphp

    <!-- Grille d'images/vidéos -->
    @if ($imagesAndVideos->isNotEmpty())
        <div class="mt-3 grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($imagesAndVideos as $file)
                <div x-data="{ open: false }">
                    @if (Str::contains($file->type, 'image'))
                        <img @click="open = true" src="{{ $file->url }}"
                            class="h-32 w-full cursor-pointer rounded-lg object-fill" alt="Image">
                    @elseif(Str::contains($file->type, 'video'))
                        <video @click="open = true" class="h-32 w-full cursor-pointer rounded-lg" muted>
                            <source src="{{ $file->url }}" type="video/mp4">
                        </video>
                    @endif

                    <!-- Modal pour afficher en grand -->
                    <div x-show="open" x-cloak x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4">
                        <div class="relative w-full max-w-4xl">
                            <button @click="open = false"
                                class="absolute right-2 top-2 rounded-full bg-white px-3 py-1 text-black">
                                ✕
                            </button>
                            @if (Str::contains($file->type, 'image'))
                                <img src="{{ $file->url }}" class="w-full rounded-lg" alt="Image agrandie">
                            @elseif(Str::contains($file->type, 'video'))
                                <video class="w-full rounded-lg" controls autoplay>
                                    <source src="{{ $file->url }}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Liste des fichiers -->
    @if ($otherFiles->isNotEmpty())
        <div class="mt-4 rounded-lg bg-gray-100 p-3 dark:bg-gray-800">
            <h3 class="text-lg font-semibold text-classic-black dark:text-classic-white">📂 Fichiers joints</h3>
            <ul class="list-inside list-disc space-y-2">
                @foreach ($otherFiles as $file)
                    <li>
                        <a href="{{ $file->url }}" target="_blank"
                            class="flex items-center gap-2 text-blue-500 underline">
                            📄 {{ basename($file->url) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
