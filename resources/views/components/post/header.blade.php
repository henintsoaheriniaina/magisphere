@props(['post'])
@php
    $statusTranslations = [
        'pending' => 'En attente',
        'approved' => 'Approuvé',
        'rejected' => 'Rejeté',
    ];
    $transitions = [
        'pending' => ['rejected' => 'Rejeter', 'approved' => 'Approuver'],
        'approved' => ['rejected' => 'Rejeter'],
        'rejected' => ['approved' => 'Approuver'],
    ];
@endphp
<div x-data="{ expanded: false, editing: false, newDescription: '{{ $post->description }}', menuOpen: false }" class="p-4">
    <div class="flex justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{ $post->user->image_url ?? asset('images/users/avatar.png') }}" alt="Avatar"
                class="h-10 w-10 rounded-full border-2 border-classic-black dark:border-classic-white">
            <div>
                <a href="{{ route('profile.show', $post->user) }}" class="font-semibold sm:text-base">
                    {{ $post->user->firstname }}
                </a>
                <div class="flex items-center gap-2">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ ucfirst($post->created_at->diffForHumans()) }}
                    </p>
                    @if ($post->category === 'announcement')
                        <p class="rounded bg-red-500 px-2 py-1 text-classic-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.3" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                            </svg>
                        </p>
                    @endif

                </div>
            </div>
        </div>
        <div class="relative flex items-center justify-center gap-2">
            @role('admin|moderator')
                <span @class([
                    'rounded-lg text-xs p-2 border-2 font-semibold ',
                    'bg-green-500 border-green-500 text-classic-white' =>
                        $post->status === 'approved',
                    'bg-yellow-500 border-yellow-500 text-classic-black' =>
                        $post->status === 'pending',
                    'bg-red-500 border-red-500 text-classic-white' =>
                        $post->status === 'rejected',
                ])>
                    {{ $statusTranslations[$post->status] ?? ucfirst($post->status) }}
                </span>
            @endrole
            <button @click="menuOpen = !menuOpen"
                class="rounded-lg border-2 border-classic-black bg-classic-white p-2 dark:border-classic-white dark:bg-classic-black">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

            </button>
            <div x-show="menuOpen" @click.away="menuOpen = false" x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="absolute right-2 top-12 z-10 mt-2 w-48 overflow-hidden rounded-lg border-2 border-classic-black bg-classic-white shadow-lg dark:border-classic-white dark:bg-classic-black">
                <a href="{{ route('posts.show', $post) }}" class="card-link">
                    Voir plus
                </a>
                @can('manage_posts', $post)
                    @foreach ($transitions[$post->status] as $newStatus => $label)
                        <form action="{{ route('admin.posts.setStatus', $post) }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" value="{{ $newStatus }}" name="status">
                            <button type="submit" class="card-link w-full text-left">{{ $label }}</button>
                        </form>
                    @endforeach

                @endcan
                @if (auth()->user()->is($post->user))
                    <button type="button" class="card-link w-full text-left"
                        @click="editing = !editing; menuOpen = false">
                        Modifier
                    </button>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="w-full">
                        @csrf
                        @method('delete')
                        <button type="submit" class="card-link w-full text-left">Supprimer</button>
                    </form>
                @endif

            </div>
        </div>
    </div>
    <div>
        <template x-if="!editing">
            <p class="mt-3 cursor-pointer" @click="expanded = !expanded">
                <span x-show="!expanded">
                    {{ Str::limit($post->description, 200, '...') }}
                    @if (strlen($post->description) > 200)
                        <br>
                        <span class="text-blue-500 hover:underline">Voir
                            plus</span>
                    @endif
                </span>
                <span x-show="expanded">
                    {{ $post->description }}
                    @if (strlen($post->description) > 200)
                        <br>
                        <span class="text-blue-500 hover:underline">Voir moin</span>
                    @endif
                </span>
            </p>
        </template>
        <template x-if="editing">
            <div class="my-4">
                <div class="auth-group">
                    <label for="newDescription" class="auth-label font-semibold">Modifier la description</label>
                    <textarea id="newDescription" x-model="newDescription" class="auth-input" rows="5"></textarea>
                </div>
                <div class="mt-2 flex space-x-2">
                    <button @click="editing = false; $refs.form.submit()" class="auth-button flex items-center">
                        Enregistrer
                    </button>
                    <button @click="editing = false" class="auth-button flex items-center bg-gray-200 text-gray-500">
                        Annuler
                    </button>
                </div>
                <form x-ref="form" method="POST" action="{{ route('posts.update', $post) }}" class="hidden">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="description" :value="newDescription">
                </form>
            </div>
        </template>
    </div>
</div>
