<div x-data="{ open: false }" @click.outside="open = false" class="relative">
    <div id="toggle-mobile-menu" class="nav-btn cursor-pointer" @click="open = !open">
        <i data-feather="menu"></i>
    </div>
    <div x-show="open" x-transition:enter="transition-opacity duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="absolute right-0 top-full mt-2 w-48 overflow-hidden rounded-lg border-2 border-classic-black bg-classic-white dark:border-classic-white dark:bg-classic-black">
        <div class="flex flex-col">
            <x-nav-link label="Accueil" link="{{ route('public.index') }}" icon="home" />
            <x-nav-link label="Posts" link="/posts" icon="book" />
            <x-nav-link label="Annonces" link="/annonces" icon="tag" />
            @guest
                <x-nav-link label="Connexion" link="{{ route('auth.login') }}" icon="log-in" />
                <x-nav-link label="Inscription" link="{{ route('auth.register') }}" icon="user-plus" />
            @endguest
            @auth
                <x-nav-link label="Poster" link="{{ route('posts.create') }}" icon="plus-square" />
                <x-nav-link label="Profile" link="#" icon="user" />

                <form action="{{ route('auth.logout') }}" method="post" class="w-full">
                    @csrf
                    @method('delete')
                    <button class="nav-link w-full">
                        <span><i data-feather="log-out"></i></span>
                        <span>Deconnexion</span>
                    </button>
                </form>
                @if (auth()->user()->is_admin())
                    <x-nav-link label="Administration" link="/admin" icon="sliders" />
                @endif
            @endauth


        </div>
    </div>
</div>
