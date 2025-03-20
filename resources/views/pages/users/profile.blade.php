<x-layouts.app title="Profile">
    <div class="secondary-container">
        @if (session('success'))
            <x-message>
                {{ session('success') }}
            </x-message>
        @endif
        {{-- profile card --}}
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
                        <div class="flex flex-col items-center justify-center gap-2 rounded-md p-2">
                            <h3 class="text-2xl font-black">{{ $user->views() }}</h3>
                            <p>Vues</p>
                        </div>
                        <div class="flex flex-col items-center justify-center gap-2 rounded-md p-2">
                            <h3 class="text-2xl font-black">{{ $user->posts->count() }}</h3>
                            <p>Publications</p>
                        </div>
                    </div>
                    <h1 class="text-center text-2xl font-bold md:text-3xl">
                        {{ $user->lastname . ' ' . $user->firstname }}
                    </h1>
                    @if ($user->bio)
                        <p class="text-center text-base md:text-lg">{{ $user->bio }} </p>
                    @endif
                    <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                        @if ($user->affiliation)
                            <div class="badge">
                                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2.3" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                    </svg>
                                </span>
                                <span>{{ $user->affiliation->label }}</span>
                            </div>
                        @endif
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
                    @role('admin')
                        <span @class([
                            'rounded px-4 py-2 text-sm font-semibold ',
                            'bg-green-500 text-white' => $user->status === 'approved',
                            'bg-yellow-500 text-black' => $user->status === 'pending',
                        ])>
                            {{ $user->status === 'approved' ? 'Approuvé' : 'En attente' }}
                        </span>
                    @endrole

                </div>
                @if (auth()->check() && auth()->user()->id === $user->id)
                    <a href="{{ route('profile.edit') }}"
                        class="absolute right-4 top-4 rounded-md border-2 border-classic-black bg-classic-white p-2 dark:border-classic-white dark:bg-classic-black"
                        title="Modifier vos informations">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>

                    </a>
                @endif
            </div>

            <div x-show="showModal" x-transition.opacity.duration.400ms x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
                @click.self="showModal = false">
                <div class="relative max-w-3xl">
                    <button @click="showModal = false"
                        class="absolute -right-4 -top-4 rounded-full bg-red-600 p-2 text-white shadow-lg hover:bg-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                            stroke="currentColor" class="size-5">
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
