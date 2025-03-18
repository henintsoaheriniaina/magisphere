@props(['post'])

<div class="rounded-xl border-2 border-classic-black p-4 dark:border-classic-white dark:bg-classic-black">
    <x-post.header :post="$post" />

    <div x-data="{ expanded: false, editing: false, newDescription: '{{ $post->description }}' }">
        <template x-if="!editing">
            <p class="mt-3 cursor-pointer" @click="expanded = !expanded">
                <span x-show="!expanded">
                    {{ Str::limit($post->description, 300, '...') }}
                </span>
                <span x-show="expanded">
                    {{ $post->description }}
                </span>
            </p>
            @if (Str::length($post->description) > 300)
                <button @click="expanded = !expanded" class="mt-2 text-blue-500 hover:underline">
                    <span x-show="!expanded">Voir plus</span>
                    <span x-show="expanded">Voir moins</span>
                </button>
            @endif
        </template>
        <template x-if="editing">
            <div class="my-4">
                <div class="auth-group">
                    <label for="newDescription" class="auth-label">Modifier la description</label>
                    <textarea id="newDescription" x-model="newDescription" class="auth-input"></textarea>
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

        @if (auth()->id() === $post->user_id)
            <button @click="editing = !editing" x-show="!editing"
                class="mt-2 flex items-center text-vintageRed-default hover:underline">Modifier
            </button>
        @endif
    </div>

    @php
        $imagesAndVideos = $post->medias->filter(fn($file) => Str::contains($file->type, ['image', 'video']));
        $otherFiles = $post->medias->reject(fn($file) => Str::contains($file->type, ['image', 'video']));
    @endphp

    @if ($imagesAndVideos->isNotEmpty())
        <x-post.media :medias="$imagesAndVideos" :post="$post" />
    @endif

    @if ($otherFiles->isNotEmpty())
        <x-post.attached :files="$otherFiles" />
    @endif
</div>
