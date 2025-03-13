@props(['post'])

<div class="rounded-lg border border-classic-black p-4 shadow-lg dark:border-classic-white">

    <div class="flex items-center space-x-3">
        <img src="{{ $post->user->image_url ?? asset('images/users/avatar.png') }}" alt="Avatar"
            class="h-10 w-10 rounded-full">
        <div>
            <h3 class="font-semibold text-classic-black dark:text-classic-white">{{ $post->user->firstname }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <p class="mt-3 text-classic-black dark:text-classic-white">{{ $post->description }}</p>

    <div class="mt-3 grid grid-cols-3 gap-2">
        @foreach ($post->medias as $file)
            @if (strpos($file->type, 'image') !== false)
                <img src="{{ $file->url }}" class="size-32 rounded-lg object-cover" alt="Image">
            @elseif(strpos($file->type, 'video') !== false)
                <video class="size-32 rounded-lg" controls>
                    <source src="{{ $file->url }}" type="video/mp4">
                </video>
            @else
                <a href="{{ $file->url }}" target="_blank" class="block text-blue-500 underline">
                    {{ basename($file->url) }}
                </a>
            @endif
        @endforeach
    </div>
</div>
