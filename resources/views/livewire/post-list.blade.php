<div class="mt-6 space-y-4">
    @foreach ($posts as $post)
        <x-post.post-card :post="$post" wire:key="post-{{ $post->id }}" />
    @endforeach

    <div class="mt-12 flex items-center justify-center">
        <div wire:loading class="mt-4 flex justify-center">
            <svg class="h-8 w-8 animate-spin text-vintageRed-default" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
    </div>

    <div x-intersect="$wire.loadMore()" class="h-2"></div>
</div>
