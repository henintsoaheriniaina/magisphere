@php
    $statusTranslations = [
        'pending' => 'En attente',
        'approved' => 'Approuvé',
        'rejected' => 'Rejeté',
    ];
@endphp
<div>
    @if ($details)
        <div class="mb-10 flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end">
            <input type="text" wire:model.live.debounce.500ms="search" placeholder="Rechercher..."
                class="auth-input w-full max-w-md px-4">
        </div>
    @endif
    <div class="relative overflow-x-auto pb-8">
        <table class="w-full text-left text-sm rtl:text-right">
            <thead class="bg-classic-black text-classic-white dark:bg-classic-white dark:text-classic-black">
                <tr>
                    <th class="cursor-pointer px-6 py-3">
                        Auteur
                    </th>
                    <th class="px-6 py-3">
                        Description
                    </th>
                    <th class="px-6 py-3">Médias</th>
                    <th class="cursor-pointer px-6 py-3" wire:click="sortBy('created_at')">
                        Date de pubication {!! $sortField === 'created_at' ? ($sortDirection === 'asc' ? '⬆' : '⬇') : '' !!}
                    </th>
                    <th class="cursor-pointer px-6 py-3" wire:click="sortBy('status')">
                        Statut {!! $sortField === 'status' ? ($sortDirection === 'asc' ? '⬆' : '⬇') : '' !!}
                    </th>
                    <th class="cursor-pointer px-6 py-3" wire:click="sortBy('category')">
                        Type {!! $sortField === 'category' ? ($sortDirection === 'asc' ? '⬆' : '⬇') : '' !!}
                    </th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="border-b bg-classic-black/10 dark:border-b-classic-white dark:bg-classic-white/10">
                        <td class="px-6 py-2">{{ $post->user->firstname . ' ' . $post->user->matriculation }}</td>
                        <td class="px-6 py-2">{{ Str::limit($post->description, 30, '...') }}</td>
                        <x-admin.media :post="$post" />
                        <td class="px-6 py-2">
                            {{ $post->created_at }}
                        </td>
                        <td class="px-6 py-2">
                            <span @class([
                                'rounded px-2.5 py-0.5 text-xs font-semibold',
                                'bg-green-500 text-classic-white' => $post->status === 'approved',
                                'bg-yellow-500 text-classic-black' => $post->status === 'pending',
                                'bg-red-500 text-classic-white' => $post->status === 'rejected',
                            ])>
                                {{ $statusTranslations[$post->status] ?? ucfirst($post->status) }}
                            </span>
                        </td>
                        <td class="min-w-40 px-6 py-2">
                            @if ($post->category === 'announcement')
                                Annonce
                            @else
                                Publication
                            @endif
                        </td>
                        <td class="flex gap-2 px-6 py-2">
                            <a href="{{ route('posts.show', $post) }}"
                                class="rounded-lg bg-classic-black p-2 text-classic-white dark:bg-classic-white dark:text-classic-black">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                            @can('manage_posts', $post)
                                @if ($post->status !== 'rejected')
                                    @if ($post->status === 'approved')
                                        <form action="{{ route('admin.posts.setStatus', $post) }}" method="POST"
                                            class="flex items-center justify-center">
                                            @csrf
                                            <input type="hidden" value="rejected" name="status">
                                            <button
                                                class="flex items-center justify-center rounded-lg bg-red-500 p-2 text-classic-white"><svg
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.posts.setStatus', $post) }}" method="POST"
                                            class="flex items-center justify-center">
                                            @csrf
                                            <input type="hidden" value="approved" name="status">
                                            <button
                                                class="flex items-center justify-center rounded-lg bg-blue-500 p-2 text-classic-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2.3" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>

                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <form action="{{ route('admin.posts.setStatus', $post) }}" method="POST"
                                        class="flex items-center justify-center">
                                        @csrf
                                        <input type="hidden" value="approved" name="status">
                                        <button
                                            class="flex items-center justify-center rounded-lg bg-blue-500 p-2 text-classic-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.3" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            @endcan

                            @role('admin')
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg bg-vintageRed-default p-2 text-classic-white"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.3" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg></button>
                                </form>
                            @endrole
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($details && $posts->count() >= $perPage)
        <div class="my-6 text-center">
            <button wire:click="loadMore" class="auth-button">Charger plus</button>
        </div>
    @endif
</div>
