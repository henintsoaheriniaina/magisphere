@php
    $medias = $post->medias->filter(fn($file) => Str::contains($file->type, ['image', 'video']));
    $otherFiles = $post->medias->reject(fn($file) => Str::contains($file->type, ['image', 'video']));
@endphp
<x-layouts.app title="Détails">
    <div class="secondary-container space-y-8">
        <div class="card">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <img src="{{ $post->user->image_url ?? asset('images/users/avatar.png') }}" alt="Avatar"
                        class="h-10 w-10 rounded-full border-2 border-classic-black dark:border-classic-white">
                    <div>
                        <a href="{{ route('profile.show', $post->user) }}" class="font-semibold">
                            {{ $post->user->firstname }}
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ ucfirst($post->created_at->diffForHumans()) }}</p>
                    </div>
                </div>

                <x-post.menu :post="$post" />
            </div>
            <div x-data="{ expanded: false }">
                <p class="mt-3 cursor-pointer" @click="expanded = !expanded">
                    <span x-show="!expanded">
                        {{ Str::limit($post->description, 300, '...') }}
                    </span>
                    <span x-show="expanded">
                        {{ $post->description }}
                    </span>
                </p>

                @if (Str::length($post->description) > 300)
                    <button @click="expanded = !expanded" class="mt-2 text-blue-500 hover:underline">
                        <span x-show="!expanded">Voir plus</span>
                        <span x-show="expanded">Voir moins</span>
                    </button>
                @endif
            </div>
            @if ($medias->isNotEmpty())
                <div x-data="{ showModal: false, modalSrc: '', isVideo: false }" class="mt-3 grid grid-cols-1 gap-2">
                    @foreach ($medias as $index => $file)
                        <div class="relative overflow-hidden rounded-lg">
                            @if (Str::contains($file->type, 'image'))
                                <img src="{{ $file->url }}" alt="Image"
                                    class="h-full max-h-[800px] w-full cursor-pointer rounded-lg object-cover object-center"
                                    @click="modalSrc = '{{ $file->url }}'; isVideo = false; showModal = true">
                            @elseif(Str::contains($file->type, 'video'))
                                <video class="h-full max-h-[80vh] w-full rounded-lg object-cover" muted playsinline>
                                    <source src="{{ $file->url }}" type="video/mp4">
                                </video>
                                <button
                                    class="absolute inset-0 m-4 flex items-center justify-center rounded-lg bg-black bg-opacity-40 text-white"
                                    @click="modalSrc = '{{ $file->url }}'; isVideo = true; showModal = true">
                                    <i data-feather="play"></i>
                                </button>
                            @endif
                        </div>
                    @endforeach

                    <div x-show="showModal" x-cloak x-transition:enter="transition-opacity duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80 px-8"
                        @keydown.escape.window="showModal = false; if (isVideo) { $refs.videoPlayer.pause(); }"
                        @click.away="showModal = false; if (isVideo) { $refs.videoPlayer.pause(); }">
                        <div class="relative" @click.stop>
                            <button
                                class="absolute -right-4 -top-4 z-10 rounded-lg bg-vintageRed-default p-2 text-white"
                                @click="showModal = false; if (isVideo) { $refs.videoPlayer.pause(); }">
                                <i data-feather="x"></i>
                            </button>
                            <template x-if="!isVideo">
                                <img :src="modalSrc" class="max-h-[90vh] w-auto rounded-lg">
                            </template>
                            <template x-if="isVideo">
                                <video controls class="max-h-[90vh] w-auto rounded-lg" x-ref="videoPlayer">
                                    <source :src="modalSrc" type="video/mp4">
                                </video>
                            </template>
                        </div>
                    </div>
                </div>
            @endif
        </div>


        @if ($otherFiles->isNotEmpty())
            <div class="card">
                <h3 class="mb-3 text-lg font-semibold">Fichiers joints</h3>
                <ul class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($otherFiles as $file)
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

        @endif

    </div>
</x-layouts.app>
