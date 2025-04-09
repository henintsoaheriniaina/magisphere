<div class="space-y-8">
    <div class="mb-10 flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end">
        <input type="text" wire:model.live.debounce.500ms="query" placeholder="Rechercher..."
            class="auth-input w-full max-w-md px-4">
    </div>
    <div>
        <h2 class="mb-4 text-xl font-bold">Utilisateurs</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @forelse($users as $user)
                <div class="flex flex-col items-center justify-center gap-2 rounded-lg border-2 border-classic-black bg-classic-white p-4 text-center dark:border-classic-white dark:bg-classic-black"
                    wire:key="user-{{ $user->id }}">
                    <div class="flex items-center justify-center">
                        <div
                            class="size-32 cursor-pointer items-center justify-center overflow-hidden rounded-full border-2 border-classic-black bg-classic-white p-2 dark:border-classic-white dark:bg-classic-black">
                            <img src="{{ $user->image_url ?? asset('images/users/avatar.png') }}"
                                alt="Photo de profil de {{ $user->firstname }}"
                                class="h-full w-full rounded-full object-cover">
                        </div>
                    </div>
                    <p class="text-xl font-semibold">{{ $user->lastname . ' ' . $user->firstname }}</p>
                    <div class="flex items-center justify-center gap-2">
                        <x-chat.chat-button :user="$user" />
                        <a href="{{ route('profile.show', $user) }}"
                            class="btn bg-classic-black/30 dark:bg-classic-white/30">Profil</a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Aucun utilisateur trouvé.</p>
            @endforelse
        </div>
        @if ($users->count() >= $usersPage * 10)
            <div class="mt-4 text-center">
                <button wire:click="loadMoreUsers" class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700">
                    Charger plus
                </button>
            </div>
        @endif
    </div>
    <div>
        <h2 class="mb-4 text-xl font-bold">Publications</h2>
        <div class="grid grid-cols-1 gap-4">
            @forelse($posts as $post)
                <div class="break-inside-avoid" wire:key="user-{{ $post->id }}">
                    <x-post.post-card :post="$post" />
                </div>
            @empty
                <p class="text-gray-500">Aucune publication trouvée.</p>
            @endforelse
        </div>
        @if ($posts->count() >= $postsPage * 10)
            <div class="mt-4 text-center">
                <button wire:click="loadMorePosts" class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700">
                    Charger plus
                </button>
            </div>
        @endif
    </div>

</div>
