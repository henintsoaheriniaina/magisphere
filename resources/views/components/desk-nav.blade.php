<div class="hidden gap-6 lg:flex">
    <x-nav-link link="{{ route('index') }}" icon="home" />
    <x-nav-link link="{{ route('profiles.show', auth()->user()) }}" icon="user" />
    <form action="{{ route('logout') }}" method="post" class="w-full">
        @csrf
        @method('delete')
        <button class="nav-link w-full">
            <span><i data-feather="log-out"></i></span>
        </button>
    </form>
</div>
