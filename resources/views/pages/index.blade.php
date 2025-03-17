<x-layouts.app>
    <div class="min-h-screen secondary-container">
        @if (session('success'))
            <div class="mb-6">
                <x-message>
                    {{ session('success') }}
                </x-message>
            </div>
        @endif
        <x-post.form />
        <livewire:post-list />
    </div>
</x-layouts.app>
