@props(['post'])

<div class="flex items-center justify-between">
    <div class="flex items-center space-x-3">
        <img src="{{ $post->user->image_url ?? asset('images/users/avatar.png') }}" alt="Avatar"
            class="h-10 w-10 rounded-full border-2 border-classic-black dark:border-classic-white">
        <div>
            <a href="{{ route('profile.show', $post->user) }}" class="font-semibold">
                {{ $post->user->firstname }}
            </a>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ ucfirst($post->created_at->diffForHumans()) }}</p>
        </div>
    </div>

    <x-post.menu :post="$post" />
</div>
