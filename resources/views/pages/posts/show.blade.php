@php
    $medias = $post->medias->filter(fn($file) => Str::contains($file->type, ['image', 'video']));
    $otherFiles = $post->medias->reject(fn($file) => Str::contains($file->type, ['image', 'video']));
    $statusTranslations = [
        'pending' => 'En attente',
        'approved' => 'Approuvé',
        'rejected' => 'Rejeté',
    ];
@endphp
<x-layouts.app title="Détails">
    <div class="secondary-container">
        <div class="my-4">
            <x-success-message />
        </div>
    </div>
    <div class="secondary-container my-4">
        <x-back />
    </div>
    <div class="secondary-container min-h-screen space-y-6">
        <div class="card">
            <x-post.header :post="$post" />
            <div class="mt-3 flex items-center gap-4">
                <livewire:like-button :post="$post" :key="'like-button-' . $post->id" />
                <a href="{{ route('posts.show', $post) . '#comments' }}" class="hover:text-vintageRed-default">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd"
                                d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97ZM6.75 8.25a.75.75 0 0 1 .75-.75h9a.75.75 0 0 1 0 1.5h-9a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-bold">{{ $post->comments->count() }}</span>
                    </div>
                </a>
            </div>
        </div>

        @if ($medias->isNotEmpty())
            <div class="card">
                <h1 class="mb-6 text-2xl font-bold">Médias</h1>
                <div x-data="{ showModal: false, modalSrc: '', isVideo: false }" class="mt-3 grid grid-cols-1 gap-2 md:grid-cols-2">
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
                                    class="absolute inset-0 flex items-center justify-center rounded-lg bg-black bg-opacity-40 text-classic-white"
                                    @click="modalSrc = '{{ $file->url }}'; isVideo = true; showModal = true">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2.3" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                    </svg>
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
                                class="absolute -right-4 -top-4 z-10 rounded-lg bg-vintageRed-default p-2 text-classic-white"
                                @click="showModal = false; if (isVideo) { $refs.videoPlayer.pause(); }">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>

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
            </div>
        @endif
        @if ($otherFiles->isNotEmpty())
            <div class="card" id="attached">
                <h3 class="mb-3 text-lg font-semibold">Fichiers joints</h3>
                <ul class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    @foreach ($otherFiles as $file)
                        <div
                            class="flex flex-col items-start justify-between gap-3 rounded-lg bg-white p-3 shadow-sm dark:bg-gray-700 md:flex-row">
                            <div class="w-full gap-3">
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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>

                            </a>
                        </div>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card" id="comments">
            <livewire:post.comment-section :perPage="5" :details="true" :post="$post" />
        </div>
    </div>
</x-layouts.app>
