<x-layouts.app>
    <div class="hidden border-2 border-red-600 lg:col-span-3 lg:block">
    </div>
    <div class="min-h-[200vh] py-4 lg:col-span-9">
        <form action="{{ route('posts.store') }}" method="POST"
            class="mx-auto grid w-full grid-cols-1 gap-6 rounded-lg border-2 border-classic-black p-6 dark:border-classic-white">
            <h1 class="text-2xl font-bold text-vintageRed-default">Créer une nouvelle publication</h1>
            @csrf

            <div class="auth-group">
                <label for="description" class="auth-label @error('description') error @enderror">Description</label>
                <textarea name="description" id="description" class="auth-input @error('description') error @enderror" rows="4"></textarea>
                @error('description')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>

            <div class="space-y-4">
                <button type="submit" class="auth-button">Publier</button>
            </div>
        </form>
    </div>

</x-layouts.app>
