<x-layouts.app title="Créer">
    <div class="mt-10 flex min-h-[70vh] flex-col justify-center gap-10 md:gap-20">
        <form action="" method="POST"
            class="mx-auto grid w-full max-w-full grid-cols-1 gap-6 md:mx-0 md:max-w-full md:grid-cols-2">
            @csrf
            <h1 class="text-2xl font-bold text-vintageRed-default md:col-span-2">Publier</h1>
            <div class="auth-group md:col-span-2">
                <label for="description" class="auth-label @error('description') error @enderror">Description</label>
                <textarea name="description" rows="4" id="description"
                    class="auth-input @error('description') error @enderror col-span-3">{{ old('description') }}</textarea>
                @error('description')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>

            <div class="auth-group md:col-span-2">
                <label for="category" class="auth-label @error('category') error @enderror">Catégorie</label>
                <select name="category" id="category" class="auth-input @error('category') error @enderror">
                    <option value="annoucement" {{ old('category') == 'annoucement' ? 'selected' : '' }}>Annonce
                    </option>
                    <option value="post" {{ old('category', 'post') == 'post' ? 'selected' : '' }}>Post</option>
                </select>
                @error('category')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>

            <div class="space-y-2 md:col-span-2">
                <button type="submit" class="auth-button">Publier</button>
            </div>
        </form>
    </div>

</x-layouts.app>
