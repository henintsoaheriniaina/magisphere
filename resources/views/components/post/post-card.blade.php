@props(['post'])

<div class="rounded-xl border-2 border-classic-black p-4 dark:border-classic-white dark:bg-classic-black">
    <x-post.header :post="$post" />

    <p class="mt-3">{{ $post->description }}</p>

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
