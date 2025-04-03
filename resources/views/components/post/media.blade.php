@props(['medias', 'post'])

<div x-data="{ showModal: false, modalSrc: '', isVideo: false }"
    class="{{ $medias->count() > 1 ? 'grid-cols-2 lg:grid-cols-2' : 'grid-cols-1' }} mt-3 grid gap-2">
    @foreach ($medias->take(4) as $index => $file)
        <div class="relative overflow-hidden rounded-lg">
            @if (Str::contains($file->type, 'image'))
                <img src="{{ $file->url }}" alt="Image"
                    class="h-full max-h-[600px] w-full cursor-pointer object-cover object-center"
                    @click="modalSrc = '{{ $file->url }}'; isVideo = false; showModal = true">
            @elseif(Str::contains($file->type, 'video'))
                <video class="h-full w-full object-cover" muted playsinline>
                    <source src="{{ $file->url }}" type="video/mp4">
                </video>
                <button
                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40 text-classic-white"
                    @click="modalSrc = '{{ $file->url }}'; isVideo = true; showModal = true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                    </svg>
                </button>
            @endif

            @if ($medias->count() > 4 && $loop->last)
                <a href="{{ route('posts.show', $post) }}"
                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-lg font-semibold text-classic-white">
                    +{{ $medias->count() - 4 }} autres
                </a>
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
            <button class="absolute -right-4 -top-4 z-10 rounded-lg bg-vintageRed-default px-4 py-2 text-classic-white"
                @click="showModal = false; if (isVideo) { $refs.videoPlayer.pause(); }">
                X
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
