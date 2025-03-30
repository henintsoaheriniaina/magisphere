<x-layouts.app title="Publications">

    <div class="lg:col-span-8">
        @if (session('success'))
            <div class="mb-6">
                <x-message>
                    {{ session('success') }}
                </x-message>
            </div>
        @endif
        <x-back />
        <div class="my-10 flex items-center justify-between gap-6">
            <h1 class="text-3xl font-black md:text-4xl">Publications ({{ $count }})</h1>
            <a href="{{ route('admin.posts.create') }}" class="auth-button flex items-center justify-center gap-3">
                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>
                <span class="hidden whitespace-nowrap sm:inline">Ajouter</span>
            </a>
        </div>
        <livewire:admin.post-list details />
    </div>
</x-layouts.app>
