<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="p-1">
        <i data-feather="more-vertical"></i>
    </button>
    <div x-show="open" @click.away="open = false" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="absolute right-0 z-10 mt-2 w-48 rounded-lg border border-classic-black bg-classic-white shadow-lg dark:border-classic-white dark:bg-classic-black">
        <a href="#"
            class="block px-4 py-2 text-sm text-classic-black hover:bg-vintageRed-light dark:text-classic-white dark:hover:bg-vintageRed-dark">
            Modifier
        </a>
        <a href="#"
            class="block px-4 py-2 text-sm text-classic-black hover:bg-vintageRed-light dark:text-classic-white dark:hover:bg-vintageRed-dark">
            Supprimer
        </a>
    </div>
</div>
