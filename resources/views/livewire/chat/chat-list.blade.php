<div x-data="{ query: @entangle('query') }" x-init="setTimeout(() => {
    conversationElement = document.getElementById('conversation-' + query);
    if (conversationElement) {
        conversationElement.scrollIntoView({ 'behavior': 'smooth' });
    }
}, 200);
Echo.private('users.{{ Auth()->User()->id }}')
    .notification((notification) => {
        if (notification['type'] == 'App\\Notifications\\MessageRead' || notification['type'] == 'App\\Notifications\\MessageSent') {
            window.Livewire.dispatch('refresh');
            {{-- $wire.dispatch('refresh'); --}}
        }
    });"
    class="flex h-full min-w-full flex-col overflow-hidden transition-all">
    <header class="w-fullp-4 sticky top-0 z-10 p-4">
        <div class="flex items-center justify-between border-b-2 border-classic-black pb-4 dark:border-classic-white">
            <div class="flex items-center gap-2">
                <h5 class="text-2xl font-bold">Conversations</h5>
            </div>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                </svg>
            </button>
        </div>
        {{-- Search --}}
        <div class="my-4">
            <input type="text" wire:model.live="search" placeholder="Rechercher une conversation..."
                class="w-full rounded-lg bg-white px-4 py-2 text-classic-black outline-none dark:bg-white/20 dark:text-classic-white">
        </div>
    </header>
    <main class="scroll-hidden relative h-full grow overflow-hidden overflow-y-scroll" style="contain:content">
        <ul class="grid w-full gap-2 p-2">
            @if ($conversations)
                @foreach ($conversations as $key => $conversation)
                    <li id="conversation-{{ $conversation->id }}" wire:key="{{ 'conversation- ' . $key }}"
                        class="{{ $conversation->id == $selectedConversation?->id ? 'dark:bg-classic-white/20 bg-gray-200' : '' }} flex w-full cursor-pointer gap-4 rounded-lg px-4 py-2 transition-colors duration-150 hover:bg-gray-200 dark:hover:bg-classic-white/20">
                        <a href="#" class="flex shrink-0 items-center justify-center">
                            <x-chat.avatar :src="$conversation->getReceiver()->image_url" />
                        </a>
                        <aside class="grid w-full grid-cols-12">
                            <a href="{{ route('chat.main', $conversation->id) }}"
                                class="relative col-span-11 w-full flex-nowrap space-y-1 overflow-hidden truncate py-2 leading-5">
                                {{-- name and date  --}}
                                <div class="flex w-full items-center justify-between gap-1">
                                    <h6 class="truncate font-medium tracking-wider">
                                        {{ $conversation->getReceiver()->lastname . ' ' . $conversation->getReceiver()->firstname }}
                                    </h6>
                                </div>
                                {{-- Message body --}}
                                <div class="flex items-center gap-x-2">
                                    @if ($conversation->unreadMessagesCount() > 0)
                                        <span
                                            class="shrink-0 rounded-full bg-vintageRed-default p-[6px] text-xs font-bold">
                                        </span>
                                    @endif
                                    @if ($conversation?->messages?->last())
                                        <p class="grow truncate text-sm font-light">
                                            {{ $conversation?->messages?->last()?->sender_id == auth()->id() ? 'Vous: ' : '' }}
                                            {{ $conversation?->messages?->last()?->body ?? '' }}
                                        </p>
                                    @else
                                        <p class="grow truncate text-sm font-light">
                                            Aucun message pour le moment.
                                        </p>
                                    @endif
                                    <small>{{ $conversation->messages?->last()?->created_at?->shortAbsoluteDiffForHumans() }}</small>

                                    @if ($conversation?->messages?->last()?->sender_id == auth()->id())
                                        @if ($conversation->isLastMessageReadByUser())
                                            <span class="relative">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="size-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="absolute right-1 top-0 size-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        @else
                                            <span class="relative">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="size-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </a>
                            {{-- Dropdown --}}
                            <div class="col-span-1 my-auto flex flex-col text-center">
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.3" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-cloak
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 transform scale-95"
                                        x-transition:enter-end="opacity-100 transform scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 transform scale-100"
                                        x-transition:leave-end="opacity-0 transform scale-95"
                                        class="-2 absolute right-0 z-10 mt-2 w-32 overflow-hidden rounded-lg bg-classic-white shadow-lg dark:bg-classic-black">
                                        <a href="{{ route('profile.show', $conversation->getReceiver()) }}"
                                            class="card-link text-left">
                                            Profile
                                        </a>
                                        <button
                                            onclick="confirm('Êtes-vous sûr de vouloir supprimer cette conversation ?')||event.stopPropagation()"
                                            wire:click="deletedByUser
('{{ encrypt($conversation->id) }}')
"
                                            class="card-link w-full text-left">
                                            Supprimer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </li>
                @endforeach
            @endif
        </ul>
    </main>
</div>
