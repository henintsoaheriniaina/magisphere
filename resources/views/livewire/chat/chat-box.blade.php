<div class="w-full overflow-hidden">
    <div class="flex h-full grow flex-col overflow-scroll">
        {{-- header --}}
        <header
            class="sticky inset-x-0 top-0 z-10 flex w-full border-b-2 border-classic-black py-2 dark:border-classic-white">
            <div class="flex w-full items-center gap-2 px-2 md:gap-5 lg:px-4">
                <a class="shrink-0 lg:hidden" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>
                </a>
                {{-- avatar --}}
                <div class="shrink-0">
                    <x-chat.avatar class="h-9 w-9 lg:h-11 lg:w-11" />
                </div>
                <a href="#" class="truncate font-bold"> {{ fake()->name() }} </a>
            </div>
        </header>
        {{-- main --}}
        <main id="conversation"
            class="my-auto flex w-full flex-grow flex-col gap-3 overflow-y-auto overflow-x-hidden overscroll-contain p-2">

            @if (true)
                {{-- keep track of the previous message --}}
                <div @class([
                    'max-w-[85%] md:max-w-[78%] flex w-auto gap-2 relative mt-2',
                    'ml-auto' => false,
                ])>

                    {{-- avatar --}}
                    <div @class(['shrink-0'])>
                        <x-chat.avatar />
                    </div>
                    {{-- messsage body --}}
                    <div @class([
                        'flex flex-wrap rounded-xl p-2 flex flex-col ',
                        'rounded-bl-none bg-classic-black text-classic-white dark:bg-classic-white dark:text-classic-black' => 0,
                        'rounded-br-none bg-vintageRed-default text-classic-white' => 1,
                    ])>
                        <p class="truncate whitespace-normal text-sm tracking-wide md:text-base lg:tracking-normal">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi repellat fugit non rem
                            soluta
                            alias quo veritatis enim ad cum inventore esse, officia, maiores ipsa aliquid eveniet
                            illo?
                            Culpa, consequuntur.
                        </p>
                        <div class="ml-auto flex gap-2">
                            <p class="text-xs">
                                5 am
                            </p>
                            {{-- message status , only show if message belongs auth --}}
                            @if (true)
                                <div>
                                    {{-- double ticks --}}
                                    <span class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                            <path
                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                        </svg>
                                    </span>

                                    {{-- single ticks --}}
                                    {{-- <span x-show="!markAsRead" @class('text-gray-200')>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                        <path
                                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </span> --}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </main>
        {{-- send --}}
        <footer class="inset-x-0 z-10 shrink-0">
            <div class="border-t-2 border-classic-black p-2 dark:border-classic-white">
                <form x-data="{ body: @entangle('body').defer }" @submit.prevent="$wire.sendMessage" method="POST" autocapitalize="off">
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
