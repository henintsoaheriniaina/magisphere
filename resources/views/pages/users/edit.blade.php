<x-layouts.app title="Modifier Votre Profile">
    <div class="lg:col-span-9">
        <h1 class="mt-12 text-center text-2xl font-bold sm:text-left">Modifier votre profile</h1>

        <x-profile-image-form />

        <form action="{{ route('profile.update') }}" class="min-h-[55vh] space-y-12" method="POST">
            @csrf
            @method('put')
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="auth-group md:col-span-2">
                    <label for="bio" class="auth-label @error('bio') error @enderror">Bio</label>
                    <textarea name="bio" rows="4" id="bio" class="auth-input @error('bio') error @enderror col-span-3">{{ old('bio', auth()->user()->bio) }}</textarea>
                    @error('bio')
                        <x-message variant="error">{{ $message }}</x-message>
                    @enderror
                </div>
            </div>
            <button type="submit" class="auth-button">Enregistrer</button>
        </form>
    </div>
</x-layouts.app>
