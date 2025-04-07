<div
    class="sticky left-0 right-0 top-0 z-50 border-b-2 border-classic-black bg-classic-white dark:border-classic-white dark:bg-classic-black">
    <div class="default-container">
        <div class="flex items-center justify-between lg:col-span-9">
            <a href="{{ route('index') }}" class="flex items-center gap-2">
                <h1 class="text-3xl font-black text-vintageRed-default">
                    <span class="hidden sm:inline">Magisphère</span>
                    <span class="sm:hidden">M</span>
                </h1>
            </a>
            <div class="flex items-center justify-center gap-6">
                <x-desk-nav />
                <a href="{{ route('toggleTheme') }}" class="nav-btn">
                    @if (auth()->user()->theme === 'dark')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>
                    @endif
                </a>
                <x-mobile-menu />
            </div>
        </div>
    </div>
</div>
