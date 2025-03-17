@props(['post'])
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="p-1">
        <i data-feather="more-vertical"></i>
    </button>
    <div x-show="open" @click.away="open = false" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="-2 absolute right-0 z-10 mt-2 w-48 overflow-hidden rounded-lg border border-classic-black bg-classic-white shadow-lg dark:border-classic-white dark:bg-classic-black">
        <a href="{{ route('posts.show', $post) }}" class="card-link">
            Voir plus
        </a>
        <a href="{{ route('posts.edit', $post) }}" class="card-link">
            Modifier
        </a>
        <a href="#" class="card-link">
            Supprimer
        </a>
    </div>
</div>
