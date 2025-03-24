@props(['post'])
<td class="px-6 py-2">
    @php
        $videos = $post->medias->filter(fn($file) => Str::contains($file->type, 'video'));
        $images = $post->medias->filter(fn($file) => Str::contains($file->type, 'image'));
        $documents = $post->medias->reject(fn($file) => Str::contains($file->type, ['image', 'video']));

        $sizeFormat = fn($size) => number_format($size / 1024, 2) . ' KB';
        $videoSize = $videos->sum('size');
        $imageSize = $images->sum('size');
        $documentSize = $documents->sum('size');
    @endphp
    <ul>
        @if ($post->medias->count() > 0)
            @if ($videos->count() > 0)
                <li>📹 {{ $videos->count() }} vidéos ({{ $sizeFormat($videoSize) }})</li>
            @endif
            @if ($images->count() > 0)
                <li>🖼️ {{ $images->count() }} images ({{ $sizeFormat($imageSize) }})</li>
            @endif
            @if ($documents->count() > 0)
                <li>📄 {{ $documents->count() }} documents ({{ $sizeFormat($documentSize) }})
                </li>
            @endif
        @else
            <li>Aucun média</li>
        @endif
    </ul>
</td>
