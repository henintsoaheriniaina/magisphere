<div x-data="{ type: 'all' }" class="flex h-full flex-col overflow-hidden transition-all">
    <header class="sticky top-0 z-10 w-full p-4">
        <div class="flex items-center justify-between border-b-2 border-classic-black pb-4 dark:border-classic-white">
            <div class="flex items-center gap-2">
                <h5 class="text-2xl font-bold">Conversations</h5>
            </div>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                </svg>
            </button>
        </div>
        {{-- Filters --}}
        <div class="scroll-hidden flex items-center gap-3 overflow-x-scroll py-4">
            <button @click="type='all'"
                :class="{ 'bg-vintageRed-default  text-classic-white border-vintageRed-default': type == 'all' }"
                class="inline-flex items-center justify-center gap-x-1 rounded-full border-2 border-classic-black px-4 py-2 text-xs font-semibold dark:border-classic-white lg:px-5 lg:py-2.5">
                Tout
            </button>
            <button @click="type='deleted'"
                :class="{ 'bg-vintageRed-default  text-classic-white border-vintageRed-default': type == 'deleted' }"
                class="inline-flex items-center justify-center gap-x-1 rounded-full border-2 border-classic-black px-4 py-2 text-xs font-semibold dark:border-classic-white lg:px-5 lg:py-2.5">
                Supprimés
            </button>
        </div>
    </header>
    <main class="scroll-hidden relative h-full grow overflow-hidden overflow-y-scroll" style="contain:content">
        <ul class="spacey-y-2 grid w-full p-2">
            <li id=""
                class="flex w-full cursor-pointer gap-4 rounded-lg px-4 py-2 transition-colors duration-150 hover:bg-gray-200 dark:hover:bg-gray-800">
                <a href="#" class="flex shrink-0 items-center justify-center">
                    <x-chat.avatar />
                </a>
                <aside class="grid w-full grid-cols-12">
                    <a href="#"
                        class="relative col-span-11 w-full flex-nowrap space-y-1 overflow-hidden truncate py-2 leading-5">
                        {{-- name and date  --}}
                        <div class="flex w-full items-center justify-between gap-1">
                            <h6 class="truncate font-medium tracking-wider">
                                {{ fake()->name() }}
                            </h6>
                            <small class="">9j
                            </small>
                        </div>
                        {{-- Message body --}}
                        <div class="flex items-center gap-x-2">
                            @if (true)
                                <span
                                    class="shrink-0 rounded-full bg-vintageRed-default p-px px-2 text-xs font-bold text-classic-white">
                                    2
                                </span>
                            @endif
                            <p class="grow truncate text-sm font-light">
                                Lorem ipsum dolorsit amet consectetur adipisicing elit. Facere quaerat, quas ipsam
                                accusantium doloribus voluptate vel ab ullam velit, pariatur, modi fuga asperiores
                                earum! Sit libero possimus in itaque quae.
                            </p>
                        </div>
                    </a>
                    {{-- Dropdown --}}
                    <div class="col-span-1 my-auto flex flex-col text-center">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="-2 absolute right-0 z-10 mt-2 w-32 overflow-hidden rounded-lg border-2 border-classic-black bg-classic-white shadow-lg dark:border-classic-white dark:bg-classic-black">
                                <a href="#" class="card-link text-left">
                                    Profile
                                </a>
                                <a href="#" class="card-link text-left">
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>
            </li>


        </ul>
    </main>
</div>
