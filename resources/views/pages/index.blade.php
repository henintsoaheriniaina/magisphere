<x-layouts.app>
    <x-profile />
    <div class="min-h-screen lg:col-span-6">
        @if (session('success'))
            <div class="mb-6">
                <x-message>
                    {{ session('success') }}
                </x-message>
            </div>
        @endif
        <x-home-form />
        <x-post-grid :posts="$posts" />
    </div>

</x-layouts.app>
