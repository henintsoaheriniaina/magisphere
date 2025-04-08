<x-layouts.app title="Profile">
    <div class="secondary-container">
        <x-success-message />
        <div class="z-0 mt-36 md:mt-52" x-data="{ showModal: false }">
            <div
                class="relative rounded-lg border-2 border-classic-black bg-classic-white dark:border-classic-white dark:bg-classic-black">
                <div class="absolute -top-28 left-0 right-0 z-0 flex items-center justify-center md:-top-40">
                    <div @click="showModal = true"
                        class="size-52 cursor-pointer items-center justify-center overflow-hidden rounded-full border-2 border-classic-black bg-classic-white p-2 dark:border-classic-white dark:bg-classic-black md:size-80">
                        <img src="{{ $user->image_url ?? asset('images/users/avatar.png') }}"
                            alt="Photo de profil de {{ $user->firstname }}"
                            class="h-full w-full rounded-full object-cover">
                    </div>
                </div>

                <div class="mt-28 flex flex-col items-center justify-center gap-6 p-4 md:mt-44 md:p-10">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col items-center justify-center gap-2 rounded-lg p-2">
                            <h3 class="text-2xl font-black">{{ $user->totalLikes() }}</h3>
                            <p>Likes</p>
                        </div>
                        <div class="flex flex-col items-center justify-center gap-2 rounded-lg p-2">
                            <h3 class="text-2xl font-black">{{ $user->posts->count() }}</h3>
                            <p>Publications</p>
                        </div>
                    </div>
                    <h1 class="text-center text-2xl font-bold md:text-3xl">
                        {{ $user->lastname . ' ' . $user->firstname }}
                    </h1>
                    {{-- <a href="mailto:{{ $user->email }}"
                        class="flex flex-col items-center justify-center gap-2 transition-colors hover:text-vintageRed-default">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.3" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </span>
                        <span class="overflow-hidden break-all text-center">{{ $user->email }}</span>

                    </a> --}}
                    @if ($user->bio)
                        <p class="text-center text-base md:text-lg">{{ $user->bio }} </p>
                    @endif
                    <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                        <div class="badge">
                            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                </svg>
                            </span>
                            <span>{{ $user->affiliation->label }}</span>
                        </div>
                        <div class="badge">
                            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                </svg>
                            </span>
                            <span>{{ $user->matriculation }}</span>
                        </div>
                    </div>
                    @role('admin|verificator')
                        <span @class([
                            'rounded px-4 py-2 text-sm font-semibold ',
                            'bg-green-500 text-classic-white' => $user->status === 'approved',
                            'bg-yellow-500 text-classic-black' => $user->status === 'pending',
                            'bg-red-500 text-classic-white' => $user->status === 'banned',
                        ])>
                            {{ $user->status === 'approved' ? 'Approuvé' : ($user->status === 'banned' ? 'Banni' : 'En attente') }}
                        </span>
                    @endrole
                </div>
                @if (auth()->id() != $user->id)
                    <form action="{{ route('chat.chat', $user->id) }}" class="flex items-center justify-center pb-6"
                        method="post">
                        @csrf
                        <button class="auth-button flex items-center justify-center gap-1">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                </svg>
                            </span>
                            <span class="mr-2">Message</span>
                        </button>
                    </form>
                @endif
                <div class="absolute right-4 top-4 flex items-center justify-center gap-4">
                    @if (auth()->user()->id === $user->id)
                        <a href="{{ route('profile.edit') }}"
                            class="rounded-lg border-2 border-classic-black bg-classic-white p-2 dark:border-classic-white dark:bg-classic-black"
                            title="Modifier vos informations">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.3" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>

                        </a>
                    @endif
                    @role('admin|verificator')
                        <div class="relative" x-data="{ open: false }">
                            <div @click="open = !open"
                                class="cursor-pointer rounded-lg border-2 border-classic-black bg-classic-white p-2 dark:border-classic-white dark:bg-classic-black">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>
                            </div>

                            <div x-show="open" @click.away="open = false" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="absolute -right-0 top-12 w-48 overflow-hidden rounded-lg border-2 border-classic-black bg-classic-white shadow-lg dark:border-classic-white dark:bg-classic-black">
                                <a href="{{ route('admin.users.edit', $user) }}" class="card-link">Modifier</a>
                                @if ($user->status !== 'banned')
                                    @if ($user->status === 'approved')
                                        <form action="{{ route('admin.users.setStatus', $user) }}" method="POST"
                                            class="w-full">
                                            @csrf
                                            <input type="hidden" value="banned" name="status">
                                            <button class="card-link w-full text-left">Bannir</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.users.setStatus', $user) }}" method="POST"
                                            class="w-full">
                                            @csrf
                                            <input type="hidden" value="approved" name="status">
                                            <button class="card-link w-full text-left">Approuver</button>
                                        </form>
                                    @endif
                                @else
                                    <form action="{{ route('admin.users.setStatus', $user) }}" method="POST"
                                        class="w-full">
                                        @csrf
                                        <input type="hidden" value="approved" name="status">
                                        <button class="card-link w-full text-left">Approuver</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button class="card-link w-full text-left">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    @endrole
                </div>
            </div>

            <div x-show="showModal" x-transition.opacity.duration.400ms x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
                @click.self="showModal = false">
                <div class="relative max-w-3xl">
                    <button @click="showModal = false"
                        class="absolute -right-4 -top-4 rounded-full bg-red-600 p-2 text-classic-white shadow-lg hover:bg-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.3" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <img src="{{ $user->image_url ?? asset('images/users/avatar.png') }}" alt="Image de profil"
                        class="max-h-[90vh] w-auto rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </div>
    <div class="secondary-container">
        <livewire:post-list :userId="$user->id" />
    </div>
</x-layouts.app>
