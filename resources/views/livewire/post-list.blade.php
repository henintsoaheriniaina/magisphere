<div class="mt-6 space-y-4">
    {{-- <div class="fixed bottom-8 right-8 z-10">
        <div class="relative">
            <div class="cursor-pointer rounded-lg border-2 border-classic-black bg-classic-white p-2 dark:border-classic-white dark:bg-classic-black"
                @click="open=!open">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                </svg>

            </div>
            <div
                class="absolute bottom-12 right-0 space-y-4 rounded-lg border-2 border-classic-black bg-classic-white p-2 dark:border-classic-white dark:bg-classic-black">
                <h1 class="border-b-2 border-b-classic-black p-2 text-center font-semibold dark:border-b-classic-white">
                    Filtrer par</h1>
                <div class="auth-group">
                    <label class="auth-label">Type:</label>
                    <select wire:model.live="typeFilter" class="auth-input select">
                        <option value="" selected></option>
                        <option value="post">Publication</option>
                        <option value="announcement">Annonces</option>
                    </select>
                </div>
                @role('admin|moderator')
                    <div class="auth-group">
                        <label class="auth-label">Status:</label>
                        <select wire:model.live="statusFilter" class="auth-input select">
                            <option value="" selected></option>
                            <option value="approved">Publié</option>
                            <option value="pending">En attente</option>
                            <option value="rejected">Rejeté</option>
                        </select>
                    </div>
                @endrole
            </div>
        </div>
    </div> --}}

    @forelse ($posts as $post)
        {{-- <x-post.post-card :post="$post" wire:key="post-{{ $post->id }}" /> --}}
        <livewire:post-card :post="$post" />
    @empty
        <p class="text-center text-gray-500">Aucune publication disponible.</p>
    @endforelse

    <div class="mt-24 flex items-center justify-center">
        <div wire:loading class="mt-4 flex justify-center">
            <svg class="h-8 w-8 animate-spin text-vintageRed-default" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
    </div>

    {{-- Chargement infini --}}
    <div x-show="$wire.hasMore" x-intersect="$wire.loadMore()" class="h-2"></div>
</div>
