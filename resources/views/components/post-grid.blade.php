@props(['posts'])
<div class="mt-6 space-y-4">
    @foreach ($posts as $post)
        <x-post-card :post="$post" />
    @endforeach
</div>
