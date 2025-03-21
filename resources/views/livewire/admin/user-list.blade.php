@php
    $roleTranslations = [
        'admin' => 'Administrateur',
        'verificator' => 'Vérificateur',
        'moderator' => 'Modérateur',
        'user' => 'Utilisateur',
    ];
@endphp
<div>
    @if ($details)
        <div class="mb-10 flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end">
            <input type="text" wire:model.live.debounce.500ms="search" placeholder="Rechercher..."
                class="auth-input w-full max-w-md px-4">
            <div class="flex items-center justify-center gap-4" x-data="{ toggle: '0' }">
                <div class="relative h-6 w-12 cursor-pointer rounded-full transition duration-200 ease-linear"
                    :class="[toggle === '1' ? 'bg-vintageRed-default' : 'bg-classic-black/10 dark:bg-classic-white/40']">
                    <label for="toggle"
                        class="absolute left-0 mb-2 h-6 w-6 transform cursor-pointer rounded-full border-2 bg-classic-white transition duration-100 ease-linear"
                        :class="[toggle === '1' ? 'translate-x-full border-vintageRed-default' :
                            'translate-x-0 border-gray-400'
                        ]"></label>
                    <input type="checkbox" id="toggle" name="toggle" wire:model='showAdmin'
                        class="h-full w-full cursor-pointer appearance-none focus:outline-none active:outline-none"
                        @click="toggle === '0' ? toggle = '1' : toggle = '0'" />
                </div>
                <div class="whitespace-nowrap">Voir les administrateurs</div>
            </div>
        </div>
    @endif
    <div class="relative overflow-x-auto">
        <table class="w-full text-left text-sm rtl:text-right">

            <thead class="bg-classic-black text-classic-white dark:bg-classic-white dark:text-classic-black">
                <tr>
                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="sortBy('lastname')">
                        Nom {!! $sortField === 'lastname' ? ($sortDirection === 'asc' ? '⬆' : '⬇') : '' !!}
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="sortBy('firstname')">
                        Prénom {!! $sortField === 'firstname' ? ($sortDirection === 'asc' ? '⬆' : '⬇') : '' !!}
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="sortBy('matriculation')">
                        Matricule {!! $sortField === 'matriculation' ? ($sortDirection === 'asc' ? '⬆' : '⬇') : '' !!}
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="sortBy('status')">
                        Statut {!! $sortField === 'status' ? ($sortDirection === 'asc' ? '⬆' : '⬇') : '' !!}
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="sortBy('email')">
                        Email {!! $sortField === 'email' ? ($sortDirection === 'asc' ? '⬆' : '⬇') : '' !!}
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="sortBy('role')">
                        Rôle {!! $sortField === 'role' ? ($sortDirection === 'asc' ? '⬆' : '⬇') : '' !!}
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="sortBy('affiliation')">
                        Affiliation {!! $sortField === 'affiliation' ? ($sortDirection === 'asc' ? '⬆' : '⬇') : '' !!}
                    </th>

                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr
                        class="border-b-2 border-b-classic-black bg-classic-black/10 dark:border-b-classic-white dark:bg-classic-white/10">
                        <td class="px-6 py-2">{{ $user->lastname }}</td>
                        <td class="px-6 py-2">{{ $user->firstname }}</td>
                        <td class="px-6 py-2">{{ $user->matriculation }}</td>
                        <td class="px-6 py-2">
                            <span @class([
                                'rounded px-2.5 py-0.5 text-xs font-semibold ',
                                'bg-green-500 text-white' => $user->status === 'approved',
                                'bg-yellow-500 text-black' => $user->status === 'pending',
                            ])>
                                {{ $user->status === 'approved' ? 'Approuvé' : 'En attente' }}
                            </span>
                        </td>

                        <td class="px-6 py-2">{{ $user->email }}</td>
                        <td class="px-6 py-2">

                            @foreach ($user->getRoleNames() as $role)
                                <span
                                    class="mr-1 rounded bg-vintageRed-default px-2.5 py-0.5 text-xs font-semibold text-white">
                                    {{ $roleTranslations[$role] ?? ucfirst($role) }}
                                </span>
                            @endforeach
                        </td>
                        <td class="px-6 py-2">{{ $user->affiliation->label }}</td>
                        <td class="flex gap-2 px-6 py-2">
                            <a href="{{ route('profile.show', $user) }}"
                                class="rounded-lg bg-classic-black p-2 text-classic-white dark:bg-classic-white dark:text-classic-black">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="rounded-lg bg-classic-black p-2 text-classic-white dark:bg-classic-white dark:text-classic-black">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>

                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-lg bg-vintageRed-default p-2 text-classic-white"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2.3" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @if ($details && $users->count() >= $perPage)
        <div class="my-6 text-center">
            <button wire:click="loadMore" class="auth-button">Charger plus</button>
        </div>
    @endif
</div>
