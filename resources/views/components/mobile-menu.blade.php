<div x-data="{ open: false }" @click.outside="open = false" class="lg:hidden">
    <div id="toggle-mobile-menu" class="nav-btn" @click="open = !open">
        <i data-feather="menu"></i>
    </div>
    <div x-show="open" x-transition:enter="transition-opacity duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="absolute right-0 top-0 flex h-screen w-full flex-col items-center justify-center overflow-hidden overflow-y-auto rounded-lg bg-classic-white dark:bg-classic-black">
        <div class="absolute top-0 w-full px-6 py-6 sm:px-10 lg:px-12">
            <div class="nav-btn ml-auto w-fit" @click="open = false">
                <i data-feather="x"></i>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <x-nav-link label="Accueil" link="{{ route('index') }}" icon="home" />
            <x-nav-link label="Profile" link="{{ route('profiles.show', auth()->user()) }}" icon="user" />
            <form action="{{ route('logout') }}" method="post" class="w-full">
                @csrf
                @method('delete')
                <button class="nav-link w-full">
                    <span><i data-feather="log-out"></i></span>
                    <span>Deconnexion</span>
                </button>
            </form>
        </div>
    </div>
</div>
