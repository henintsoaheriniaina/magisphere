<div class="mt-6 space-y-4">
    @forelse ($posts as $post)
        <x-post.post-card :post="$post" wire:key="post-{{ $post->id }}" />
    @empty
        <p class="text-center text-gray-500">Aucune publication disponible.</p>
    @endforelse

    <div class="mt-24 flex items-center justify-center">
        <div wire:loading class="mt-4 flex justify-center">
            <svg class="h-8 w-8 animate-spin text-vintageRed-default" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
    </div>

    <div x-show="$wire.hasMore" x-intersect="$wire.loadMore()" class="h-2"></div>
</div>
