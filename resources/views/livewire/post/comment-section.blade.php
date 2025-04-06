<div class="@if (!$details) pt-8 @endif my-4 space-y-4">
    @if ($details)
        <h1 class="mb-6 text-2xl font-bold">Commentaires</h1>
    @endif

    @foreach ($comments as $comment)
        <div class="@if (!$details) mx-4 @endif relative flex items-start gap-2"
            wire:key='{{ 'comment-' . $comment->id }}'>
            <!-- Avatar -->
            <img src="{{ $comment->user->image_url ?? asset('images/users/avatar.png') }}"
                alt="{{ $comment->user->firstname }}" class="h-10 w-10 flex-shrink-0 rounded-full object-cover">

            <!-- Contenu du commentaire -->
            <div class="flex-1 rounded-lg bg-gray-800 p-4 text-white" x-data="{ menuOpen: false, editing: false, commentUpdate: @js($comment->content) }">
                <div class="flex items-center justify-between">
                    <a href="{{ route('profile.show', $comment->user) }}" class="font-semibold">
                        {{ $comment->user->firstname }}
                    </a>
                    @if (auth()->id() === $comment->user_id)
                        <div class="relative flex items-center">
                            <button x-on:click="menuOpen=!menuOpen" class="rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                            </button>
                            <div x-show="menuOpen" @click.away="menuOpen = false" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="absolute right-0 top-8 z-10 w-40 overflow-hidden rounded-lg bg-classic-white text-classic-black shadow-lg dark:bg-classic-black dark:text-classic-white">
                                <div class="card-link cursor-pointer"
                                    x-on:click="$wire.deleteComment({{ $comment->id }})"
                                    wire:key='{{ 'delete-comment-' . $comment->id }}'>Supprimer
                                </div>
                                <div x-on:click="editing=true;menuOpen=false" class="card-link cursor-pointer">
                                    Modifier</div>
                            </div>
                        </div>
                    @endif
                </div>
                <div x-show="editing" class="my-2 space-y-4" x-cloak>
                    <input type="text" x-model="commentUpdate" class="auth-input @error('content') error @enderror">
                    @error('content')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="flex items-center gap-2">
                        <button class="auth-button"
                            x-on:click="$wire.updateComment({{ $comment->id }},commentUpdate );editing = false">Enregistrer</button>
                        <button x-on:click="editing = false"
                            class="rounded bg-gray-200 px-4 py-2 font-semibold text-classic-black duration-300">
                            Annuler
                        </button>
                    </div>
                </div>
                <div x-show="!editing" class="mt-1 break-words break-all text-sm">{{ $comment->content }}</div>
                <div class="mt-1 text-xs text-gray-400">{{ ucfirst($comment->created_at->diffForHumans()) }}</div>
            </div>
        </div>
    @endforeach



    <div class="flex items-center justify-center">
        <div wire:loading class="mt-4 flex justify-center">
            <svg class="h-8 w-8 animate-spin text-vintageRed-default" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
    </div>


    @if ($comments->count() > 0 && $details && ($hasMore || $isExtended))
        <div class="flex gap-3">
            @if ($hasMore)
                <button wire:click="loadMore"
                    class="flex items-center gap-2 rounded-lg bg-vintageRed-default p-2 text-classic-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                </button>
            @endif
            @if ($isExtended)
                <button wire:click="showLess"
                    class="flex items-center gap-2 rounded-lg bg-vintageRed-default p-2 text-classic-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                    </svg>
                </button>
            @endif
        </div>
    @endif
    <form wire:submit.prevent="postComment" class="@if (!$details) mx-4 @endif">
        <div
            class="flex items-center justify-between gap-2 rounded-lg border-2 border-classic-black px-2 py-2 dark:border-classic-white">
            <input type="text" wire:model="newComment" class="w-full bg-transparent px-2 outline-none"
                placeholder="Commenter">
            <button class="rounded-lg bg-vintageRed-default p-2 text-classic-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </button>
        </div>
        @error('newComment')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
    </form>
</div>
