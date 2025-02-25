<div
    class="sticky left-0 right-0 top-0 z-50 border-b-2 border-classic-black bg-classic-white dark:border-classic-white dark:bg-classic-black">
    <div class="default-container">
        <div class="flex items-center justify-between">
            <a href="{{ route('public.index') }}">
                <h1 class="text-3xl font-black text-vintageRed-default">
                    M
                </h1>
            </a>
            <div class="flex items-center justify-center gap-4">
                <a href="{{ route('public.toggleTheme') }}" class="nav-btn">
                    <i
                        data-feather="{{ auth()->check() ? (auth()->user()->theme === 'dark' ? 'moon' : 'sun') : (request()->cookie('theme', 'light') === 'dark' ? 'moon' : 'sun') }}"></i>
                </a>
                <x-mobile-menu />
            </div>
        </div>
    </div>
</div>
