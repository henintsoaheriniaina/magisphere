<x-layouts.app>
    <div class="min-h-screen lg:col-span-6 lg:col-start-2">
        @if (session('success'))
            <div class="mb-6">
                <x-message>
                    {{ session('success') }}
                </x-message>
            </div>
        @endif
        <x-home-form />
        <livewire:post-list />
    </div>
</x-layouts.app>
