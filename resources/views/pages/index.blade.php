<x-layouts.app>
    <div class="hidden lg:col-span-3 lg:block">
        <div class="fixed top-[90px] mt-6" x-data="{ showModal: false }">
            <div
                class="rounded-lg border-2 border-classic-black bg-classic-white p-6 dark:border-classic-white dark:bg-classic-black">
                <div class="flex items-center justify-center">
                    <div @click="showModal = true"
                        class="size-52 cursor-pointer items-center justify-center overflow-hidden rounded-full border-2 border-classic-black bg-classic-white p-2 dark:border-classic-white dark:bg-classic-black">
                        <img src="{{ auth()->user()->image_url ?? asset('images/users/avatar.png') }}"
                            alt="Photo de profil de {{ auth()->user()->firstname }}"
                            class="h-full w-full rounded-full object-cover">
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center gap-6 p-4">
                    <h1 class="text-center text-xl font-bold">
                        {{ auth()->user()->firstname }}
                    </h1>
                </div>
            </div>
            <div x-show="showModal" x-transition.opacity.duration.400ms
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
                @click.self="showModal = false">
                <div class="relative max-w-3xl">
                    <button @click="showModal = false"
                        class="absolute -right-4 -top-4 rounded-full bg-red-600 p-2 text-white shadow-lg hover:bg-red-700">
                        <i data-feather="x"></i>
                    </button>
                    <img src="{{ auth()->user()->image_url ?? asset('images/users/avatar.png') }}" alt="Image de profil"
                        class="max-h-[90vh] w-auto rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </div>
    <div class="min-h-[200vh] lg:col-span-6">
        @if (session('success'))
            <div class="mb-6">
                <x-message>
                    {{ session('success') }}
                </x-message>
            </div>
        @endif
        <x-home-form />
        <div class="mt-6 space-y-4">
            <h2 class="text-2xl font-bold">Dernières publications</h2>
            @foreach ($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>

</x-layouts.app>
