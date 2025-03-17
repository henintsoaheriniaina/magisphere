@props(['post'])

<div class="rounded-xl border-2 border-classic-black p-4 dark:border-classic-white dark:bg-classic-black">
    <x-post.header :post="$post" />

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

    @php
        $imagesAndVideos = $post->medias->filter(fn($file) => Str::contains($file->type, ['image', 'video']));
        $otherFiles = $post->medias->reject(fn($file) => Str::contains($file->type, ['image', 'video']));
    @endphp

    @if ($imagesAndVideos->isNotEmpty())
        <x-post.media :medias="$imagesAndVideos" :post="$post" />
    @endif

    @if ($otherFiles->isNotEmpty())
        <x-post.attached :files="$otherFiles" />
    @endif
</div>
