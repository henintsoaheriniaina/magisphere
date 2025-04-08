<div x-data="{
    height: 0,
    conversationElement: document.getElementById('conversation'),
    markAsRead: null
}" x-init="height = conversationElement.scrollHeight;
$nextTick(() => conversationElement.scrollTop = height);"
    @scroll-bottom.window="
    $nextTick(()=>conversationElement.scrollTop= conversationElement.scrollHeight);
"
    class="w-full overflow-hidden">
    <div class="scroll-hidden flex h-full flex-col overflow-scroll">
        {{-- header --}}
        <header
            class="sticky inset-x-0 top-0 z-10 flex w-full border-b-2 border-classic-black py-2 dark:border-classic-white">
            <div class="flex w-full items-center gap-2 px-2 md:gap-5 lg:px-4">
                <a class="shrink-0 lg:hidden" href="{{ route('chat.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>
                </a>
                {{-- avatar --}}
                <div class="shrink-0">
                    <x-chat.avatar :src="$selectedConversation->getReceiver()->image_url" class="h-9 w-9 lg:h-11 lg:w-11" />
                </div>
                <a href="#" class="truncate font-bold">
                    {{ $selectedConversation->getReceiver()->lastname . ' ' . $selectedConversation->getReceiver()->firstname }}
                </a>
            </div>
        </header>
        {{-- main --}}
        <main id="conversation"
            @scroll="
                scropTop = $el.scrollTop;
                if(scropTop <= 0){
                    $wire.dispatch('loadMore');
                }
            "
            @update-chat-height.window="
                newHeight= $el.scrollHeight;
                oldHeight= height;
                $el.scrollTop= newHeight- oldHeight;
                height=newHeight;
            "
            class="my-auto flex w-full flex-grow flex-col gap-3 overflow-y-auto overflow-x-hidden overscroll-contain p-2">
            <div class="flex items-center justify-center">
                <div wire:loading class="mt-4 flex justify-center">
                    <svg class="h-8 w-8 animate-spin text-vintageRed-default" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                </div>
            </div>
            @if ($loadedMessages)
                @foreach ($loadedMessages as $message)
                    {{-- keep track of the previous message --}}
                    <div @class([
                        'max-w-[85%] md:max-w-[78%] flex items-start  gap-2  relative mt-2',
                        'ml-auto' => $message->sender_id == auth()->id(),
                    ])>
                        {{-- messsage body --}}
                        <div @class([
                            'flex flex-wrap rounded-xl py-2 px-4  flex-col ',
                            'bg-classic-black text-classic-white dark:bg-classic-white dark:text-classic-black max-w-full' => !(
                                $message->sender_id == auth()->id()
                            ),
                            'bg-vintageRed-default text-classic-white' =>
                                $message->sender_id == auth()->id(),
                        ])>
                            <p
                                class="truncate whitespace-normal break-words text-sm tracking-wide md:text-base lg:tracking-normal">
                                {{ $message->body }}
                            </p>
                            <div class="ml-auto flex gap-2">
                                <p class="text-xs">
                                    {{ $message->created_at->format('H:i') }}
                                </p>
                                {{-- message status , only show if message belongs auth --}}
                                @if ($message->sender_id == auth()->id())
                                    <div>
                                        @if ($message->isRead())
                                            <span class="relative block">
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
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="size-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </main>
        {{-- send --}}
        <footer class="inset-x-0 z-10 shrink-0" wire:key='{{ 'form-' . $selectedConversation->id }}'>
            <div class="border-t-2 border-classic-black p-2 dark:border-classic-white">
                <form x-data="{ body: @entangle('body') }" @submit.prevent="$wire.sendMessage" method="POST" autocapitalize="off">
                    @csrf
                    <input type="hidden" autocomplete="false" style="display:none">
                    <div class="flex items-center gap-2">
                        <input x-model="body" type="text" autocomplete="off" autofocus maxlength="1700"
                            class="w-full rounded-lg border-0 p-2 text-classic-black outline-0 hover:ring-0 focus:border-0 focus:outline-none focus:ring-0">
                        <div class="flex w-fit items-center justify-end">
                            <button x-bind:disabled="!body.trim()" type='submit'
                                class="rounded-lg border-[3px] border-vintageRed-default bg-vintageRed-default p-2 text-classic-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
                @error('body')
                    <p> {{ $message }} </p>
                @enderror
            </div>
        </footer>
    </div>
</div>
