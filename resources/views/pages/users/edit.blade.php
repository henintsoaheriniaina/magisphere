<x-layouts.app title="Modifier Votre Profile">
    <div class="secondary-container space-y-8">
        <x-back />
        <div class="rounded-lg border-2 border-classic-black p-6 dark:border-classic-white">
            <h1 class="text-center text-2xl font-bold sm:text-left">Modifier votre profile</h1>
            <x-profile-image-form />
        </div>

        <form action="{{ route('profile.update') }}"
            class="md flex flex-col items-center justify-center gap-8 rounded-lg border-2 border-classic-black p-6 dark:border-classic-white sm:items-start sm:justify-start"
            method="POST">
            @csrf
            @method('put')
            <h1 class="text-center text-2xl font-bold sm:text-left">Modifier votre bio</h1>
            <div class="auth-group w-full">
                <textarea name="bio" rows="4" id="bio" class="auth-input @error('bio') error @enderror w-full">{{ old('bio', auth()->user()->bio) }}</textarea>
                @error('bio')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <button type="submit" class="auth-button">Enregistrer</button>
        </form>
    </div>
</x-layouts.app>
