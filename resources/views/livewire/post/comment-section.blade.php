<div class="@if (!$details) pt-8 @endif my-4 space-y-4">
    @if ($details)
        <h1 class="mb-6 text-2xl font-bold">Commentaires</h1>
    @endif
    @foreach ($comments as $comment)
        <div class="@if (!$details) mx-4 @endif relative flex gap-2">
            <div class="size-10 overflow-hidden rounded-full">
                <img src="{{ $comment->user->image_url ?? asset('images/users/avatar.png') }}"
                    alt="{{ $comment->user->firstname }}" class="size-full">
            </div>
            <div class="w-full max-w-[calc(100%-48px)] rounded-lg bg-gray-200 p-3 pr-14 dark:bg-gray-800">
                <a href="{{ route('profile.show', $comment->user) }}"
                    class="font-semibold">{{ $comment->user->firstname }}</a>
                <div class="break-words text-sm">{{ $comment->content }}</div>
                <div class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
            </div>
            @if (auth()->id() === $comment->user_id)
                <div class="absolute right-1 top-1 mr-2 mt-2">
                    <button wire:click="deleteComment({{ $comment->id }})" wire:key="delete-{{ $comment->id }}"
                        class="rounded-lg bg-vintageRed-default p-2 text-classic-white hover:bg-vintageRed-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd"
                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif
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
    @if ($details && ($hasMore || $isExtended))
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
            <input type="text" wire:model.defer="newComment" class="w-full bg-transparent px-2 outline-none"
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
