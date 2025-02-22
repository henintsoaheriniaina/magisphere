<x-layouts.app title="Profile">
    @if (session('success'))
        <x-message>
            {{ session('success') }}
        </x-message>
    @endif
    {{-- profile card --}}
    <div class="z-0 mt-36 md:mt-52">
        <div
            class="relative rounded-lg border-2 border-classic-black bg-classic-white dark:border-classic-white dark:bg-classic-black">
            <div class="absolute -top-28 left-0 right-0 z-0 flex items-center justify-center md:-top-40">
                <div
                    class="size-52 items-center justify-center overflow-hidden rounded-full border-2 border-classic-black bg-classic-white p-2 dark:border-classic-white dark:bg-classic-black md:size-80">
                    <img src="{{ $user->image_url ?? asset('images/users/avatar.png') }}"
                        alt="Photo de profil de {{ $user->firstname }}" class="h-full w-full rounded-full object-cover">
                </div>
            </div>
            <div class="mt-28 flex flex-col items-center justify-center gap-6 p-4 md:mt-44 md:p-10">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col items-center justify-center gap-2 rounded-md p-2">
                        <h3 class="text-2xl font-black">{{ $user->views() }}</h3>
                        <p>Vues</p>
                    </div>
                    <div class="flex flex-col items-center justify-center gap-2 rounded-md p-2">
                        <h3 class="text-2xl font-black">{{ $user->posts->count() }}</h3>
                        <p>Publications</p>
                    </div>
                </div>
                <h1 class="text-center text-2xl font-bold md:text-3xl">{{ $user->lastname . ' ' . $user->firstname }}
                </h1>
                @if ($user->bio)
                    <p class="text-center text-lg">{{ $user->bio }} </p>
                @endif
                <div class="flex items-center justify-center gap-4">
                    @if ($user->class)
                        <div class="badge">
                            <span> <i data-feather="briefcase"></i> </span>
                            <span>{{ $user->class }}</span>
                        </div>
                    @endif
                    <div class="badge">
                        <span> <i data-feather="info"></i> </span>
                        <span>{{ $user->matriculation }}</span>
                    </div>
                </div>
            </div>
            @if (auth()->check() && auth()->user()->id === $user->id)
                <a href="{{ route('profile.edit') }}"
                    class="absolute right-4 top-4 rounded-md border-2 border-classic-black p-2 dark:border-classic-white"
                    title="Modifier vos informations">
                    <i data-feather="edit"></i>
                </a>
            @endif
        </div>
    </div>
    {{-- latest posts --}}
</x-layouts.app>
