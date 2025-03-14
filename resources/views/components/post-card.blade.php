@props(['post'])

<div class="rounded-lg border border-classic-black p-4 shadow-lg dark:border-classic-white">

    <!-- Header du post -->
    <div class="flex items-center space-x-3">
        <img src="{{ $post->user->image_url ?? asset('images/users/avatar.png') }}" alt="Avatar"
            class="h-10 w-10 rounded-full">
        <div>
            <a href="{{ route('profile.show', $post->user) }}"
                class="font-semibold text-classic-black dark:text-classic-white">{{ $post->user->firstname }}</a>
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
            @foreach ($imagesAndVideos->take(3) as $file)
                <div x-data="{ open: false }">
                    @if (Str::contains($file->type, 'image'))
                        <div @click="open = true" class="relative h-32 cursor-pointer overflow-hidden rounded-lg">
                            <x-cld-image public-id="{{ $file->public_id }}" width="300" class="object-cover" />
                        </div>
                    @elseif(Str::contains($file->type, 'video'))
                        <div x-ref="videoContainer" class="relative cursor-pointer" @click="open = true">
                            <video x-ref="videoThumb" class="h-40 w-full rounded-lg object-cover" muted
                                playsinline></video>
                            <button
                                class="absolute inset-0 flex items-center justify-center rounded-lg bg-black bg-opacity-40 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 9l6 3-6 3V9z" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    <!-- Modal pour afficher en grand -->
                    <div x-show="open" x-cloak x-transition
                        class="fixed inset-0 top-0 z-50 flex h-screen items-center justify-center overflow-hidden bg-black p-6">
                        <div class="relative max-h-full w-full">
                            <button @click="open = false"
                                class="absolute right-2 top-2 z-10 rounded-full bg-white px-3 py-1 text-black">
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
            @if ($imagesAndVideos->count() > 3)
                <a href="{{ route('posts.show', $post) }}"
                    class="flex h-32 w-full items-center justify-center rounded-lg bg-black bg-opacity-50 text-lg font-semibold text-white">
                    +{{ $imagesAndVideos->count() - 3 }} autres
                </a>
            @endif
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
