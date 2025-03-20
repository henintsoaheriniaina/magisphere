<x-layouts.app title="Utilisateurs">

    <div class="lg:col-span-8">
        <x-back />
        <div class="my-10 flex flex-col items-center justify-between gap-6 sm:flex-row">
            <h1 class="text-3xl font-black md:text-4xl">Utilisateurs</h1>
            <a href="{{ route('admin.users.create') }}" class="auth-button flex items-center justify-center gap-3">
                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>
                <span class="whitespace-nowrap">Créer un utilisateur</span>
            </a>
        </div>
        <livewire:admin.user-list details />
    </div>
</x-layouts.app>
