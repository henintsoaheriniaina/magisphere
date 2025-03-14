@props(['medias', 'post'])

<div class="{{ $medias->count() > 1 ? 'grid-cols-2 lg:grid-cols-2' : 'grid-cols-1' }} mt-3 grid gap-2">
    @foreach ($medias->take(4) as $index => $file)
        <div class="relative overflow-hidden rounded-lg">
            @if (Str::contains($file->type, 'image'))
                <img src="{{ $file->url }}" alt="Image" class="h-full w-full object-cover">
            @elseif(Str::contains($file->type, 'video'))
                <video class="h-full w-full object-cover" muted playsinline>
                    <source src="{{ $file->url }}" type="video/mp4">
                </video>
                <button class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40 text-white">
                    <i data-feather="play"></i>
                </button>
            @endif

            @if ($medias->count() > 4 && $loop->last)
                <a href="{{ route('posts.show', $post) }}"
                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-lg font-semibold text-white">
                    +{{ $medias->count() - 4 }} autres
                </a>
            @endif
        </div>
    @endforeach
</div>
