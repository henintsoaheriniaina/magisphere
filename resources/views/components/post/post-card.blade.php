@props(['post'])
@php
    $imagesAndVideos = $post->medias->filter(fn($file) => Str::contains($file->type, ['image', 'video']));
    $otherFiles = $post->medias->reject(fn($file) => Str::contains($file->type, ['image', 'video']));
@endphp
<div class="rounded-xl border-2 border-classic-black dark:border-classic-white dark:bg-classic-black">
    <x-post.header :post="$post" />
    @if ($imagesAndVideos->isNotEmpty())
        <x-post.media :medias="$imagesAndVideos" :post="$post" />
    @endif
    @if ($otherFiles->isNotEmpty())
        <x-post.attached :files="$otherFiles" :post="$post" />
    @endif
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
    <livewire:post.comment-section :perPage="1" :post="$post" :wire:key="$post->id" />
</div>
