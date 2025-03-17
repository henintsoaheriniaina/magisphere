@props(['medias', 'post'])

<div x-data="{ showModal: false, modalSrc: '', isVideo: false }"
    class="{{ $medias->count() > 1 ? 'grid-cols-2 lg:grid-cols-2' : 'grid-cols-1' }} mt-3 grid gap-2">
    @foreach ($medias->take(4) as $index => $file)
        <div class="relative overflow-hidden rounded-lg">
            @if (Str::contains($file->type, 'image'))
                <img src="{{ $file->url }}" alt="Image" class="h-full w-full cursor-pointer object-cover"
                    @click="modalSrc = '{{ $file->url }}'; isVideo = false; showModal = true">
            @elseif(Str::contains($file->type, 'video'))
                <video class="h-full w-full object-cover" muted playsinline>
                    <source src="{{ $file->url }}" type="video/mp4">
                </video>
                <button class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40 text-white"
                    @click="modalSrc = '{{ $file->url }}'; isVideo = true; showModal = true">
                    <i data-feather="play"></i>
                </button>
            @endif

            @if ($medias->count() > 4 && $loop->last)
                <a href="{{ route('posts.show', $post) }}"
                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-lg font-semibold text-white">
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
        @keydown.escape.window="showModal = false">
        <div class="relative" @click.away="showModal = false" @click.stop>
            <button class="absolute -right-4 -top-4 rounded-lg bg-vintageRed-default p-2 text-white"
                @click="showModal = false">
                <i data-feather="x"></i>
            </button>
            <template x-if="!isVideo">
                <img :src="modalSrc" class="max-h-[90vh] w-auto rounded-lg">
            </template>
            <template x-if="isVideo">
                <video controls class="max-h-[90vh] w-auto rounded-lg">
                    <source :src="modalSrc" type="video/mp4">
                </video>
            </template>
        </div>
    </div>
</div>
