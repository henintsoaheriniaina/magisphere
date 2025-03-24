@props(['post'])
@php
    $statusTranslations = [
        'pending' => 'En attente',
        'approved' => 'Approuvé',
        'rejected' => 'Rejeté',
    ];
@endphp
<div class="flex justify-between">
    <div class="flex items-center space-x-3">
        <img src="{{ $post->user->image_url ?? asset('images/users/avatar.png') }}" alt="Avatar"
            class="h-10 w-10 rounded-full border-2 border-classic-black dark:border-classic-white">
        <div>
            <a href="{{ route('profile.show', $post->user) }}" class="font-semibold">
                {{ $post->user->firstname }}
            </a>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ ucfirst($post->created_at->diffForHumans()) }}</p>
        </div>
        @role('admin|moderator')
            <div class="flex items-center justify-center self-stretch">
                <span @class([
                    'rounded px-2 py-0.5 text-xs font-semibold mt-auto',
                    'bg-green-500 text-classic-white' => $post->status === 'approved',
                    'bg-yellow-500 text-classic-black' => $post->status === 'pending',
                    'bg-red-500 text-classic-white' => $post->status === 'rejected',
                ])>
                    {{ $statusTranslations[$post->status] ?? ucfirst($post->status) }}
                </span>
            </div>
        @endrole
    </div>

    <x-post.menu :post="$post" />
</div>
