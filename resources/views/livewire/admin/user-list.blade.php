@props(['details' => false])
<div>
    @if ($details)
        <div class="mb-4 flex items-center justify-between">
            <input type="text" wire:model.live.debounce.500ms="search" placeholder="Rechercher..." class="auth-input">
        </div>
    @endif
    <div class="relative overflow-x-auto rounded-lg border-2 p-4">
        <table class="w-full text-left text-sm rtl:text-right">
            <thead class="bg-classic-black text-classic-white dark:bg-classic-white dark:text-classic-black">
                <tr>
                    <th scope="col" class="px-6 py-3">Nom</th>
                    <th scope="col" class="px-6 py-3">Prénom</th>
                    <th scope="col" class="px-6 py-3">Matricule</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Rôle</th>
                    <th scope="col" class="px-6 py-3">Affiliation</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr
                        class="border-b-2 border-b-classic-black bg-classic-black/10 dark:border-b-classic-white dark:bg-classic-white/10">
                        <td class="whitespace-nowrap px-6 py-2">{{ $user->lastname }}</td>
                        <td class="whitespace-nowrap px-6 py-2">{{ $user->firstname }}</td>
                        <td class="whitespace-nowrap px-6 py-2">{{ $user->matriculation }}</td>
                        <td class="whitespace-nowrap px-6 py-2">{{ $user->email }}</td>
                        <td class="px-6 py-2">
                            <span @class([
                                'rounded px-2.5 py-0.5 text-xs font-semibold',
                                'bg-[#B22222] text-white' => $user->hasRole('admin'),
                                'bg-[#8B0000] text-white' => $user->hasRole('verificator'),
                                'bg-[#CD5C5C] text-black' => $user->hasRole('moderator'),
                                'bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900' => !$user->hasRole(
                                    ['admin', 'verificator', 'moderator']),
                            ])>
                                {{ $user->getRoleNames()->first() ?? 'Utilisateur' }}
                            </span>
                        </td>
                        <td class="px-6 py-2">{{ $user->affiliation->label }}</td>
                        <td class="px-6 py-2">
                            <a href="#"
                                class="font-medium text-green-600 hover:underline dark:text-green-500">Détails</a>
                            <a href="#"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-500">Modifier</a>
                            <a href="#"
                                class="font-medium text-red-600 hover:underline dark:text-red-500">Supprimer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
