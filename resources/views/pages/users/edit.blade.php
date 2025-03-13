<x-layouts.app title="Modifier Votre Profile">
    <div class="lg:col-span-9">
        <h1 class="mt-12 text-center text-2xl font-bold sm:text-left">Modifier votre profile</h1>

        <x-profile-image-form />

        <form action="{{ route('profile.update') }}" class="min-h-[55vh] space-y-12" method="POST">
            @csrf
            @method('put')
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="auth-group">
                    <label for="lastname" class="auth-label">Nom</label>
                    <input type="text" id="lastname" class="auth-input" value="{{ auth()->user()->lastname }}"
                        readonly>
                </div>
                <div class="auth-group">
                    <label for="firstname" class="auth-label">Prénoms</label>
                    <input type="text" id="firstname" class="auth-input" value="{{ auth()->user()->firstname }}"
                        readonly>
                </div>
                <div class="auth-group">
                    <label for="affiliation" class="auth-label">Affiliation</label>
                    <input type="text" id="firstname" class="auth-input"
                        value="{{ auth()->user()->affiliation?->label }}" readonly>
                </div>
                <div class="auth-group">
                    <label for="matriculation" class="auth-label">Matriculation</label>
                    <input type="text" id="matriculation" class="auth-input"
                        value="{{ auth()->user()->matriculation }}" readonly>
                </div>
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
