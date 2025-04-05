<x-layouts.app title="Rechercher">
    <div class="lg:col-span-8">
        @if (session('success'))
            <div class="mb-6">
                <x-message>
                    {{ session('success') }}
                </x-message>
            </div>
        @endif
        <x-back />
        <h1 class="my-10 text-3xl font-black md:text-4xl">Rechercher</h1>
        <livewire:search />
    </div>
</x-layouts.app>
