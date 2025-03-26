@props(['post'])
@php
    $transitions = [
        'pending' => ['rejected' => 'Rejeter', 'approved' => 'Approuver'],
        'approved' => ['rejected' => 'Rejeter'],
        'rejected' => ['approved' => 'Approuver'],
    ];
@endphp
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="p-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
        </svg>
    </button>
    <div x-show="open" @click.away="open = false" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="-2 absolute right-0 z-10 mt-2 w-48 overflow-hidden rounded-lg border-2 border-classic-black bg-classic-white shadow-lg dark:border-classic-white dark:bg-classic-black">
        <a href="{{ route('posts.show', $post) }}" class="card-link">
            Voir plus
        </a>
        @can('manage_posts', $post)


            @foreach ($transitions[$post->status] as $newStatus => $label)
                <form action="{{ route('admin.posts.setStatus', $post) }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" value="{{ $newStatus }}" name="status">
                    <button type="submit" class="card-link w-full text-left">{{ $label }}</button>
                </form>
            @endforeach

        @endcan
        @if (auth()->user()->is($post->user))
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="w-full">
                @csrf
                @method('delete')
                <button type="submit" class="card-link w-full text-left">Supprimer</button>
            </form>
        @endif

    </div>
</div>
