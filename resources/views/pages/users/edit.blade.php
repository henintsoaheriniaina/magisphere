<x-layouts.app title="Modifier Votre Profile">
    <h1 class="mt-12 text-center text-2xl font-bold sm:text-left">Modifier votre profile</h1>

    <x-profile-image-form />

    <form action="{{ route('profile.update') }}" class="min-h-[55vh] space-y-12" method="POST">
        @csrf
        @method('put')
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="auth-group">
                <label for="lastname" class="auth-label @error('lastname') error @enderror">Nom</label>
                <input type="text" name="lastname" id="lastname"
                    class="auth-input @error('lastname') error @enderror"
                    value="{{ old('lastname', auth()->user()->lastname) }}">
                @error('lastname')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="firstname" class="auth-label @error('firstname') error @enderror">Prénoms</label>
                <input type="text" name="firstname" id="firstname"
                    class="auth-input @error('firstname') error @enderror"
                    value="{{ old('firstname', auth()->user()->firstname) }}">
                @error('firstname')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="affiliation" class="auth-label @error('affiliation') error @enderror">Affiliation</label>
                <select name="affiliation" id="affiliation"
                    class="auth-input select @error('affiliation') error @enderror">
                    <option value="">Sélectionnez votre affiliation</option>
                    @foreach ($affiliations as $affiliation)
                        <option value="{{ $affiliation->id }}"
                            {{ old('affiliation', auth()->user()->affiliation_id) == $affiliation->id ? 'selected' : '' }}>
                            {{ $affiliation->label }}
                        </option>
                    @endforeach
                </select>
                @error('affiliation')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="matriculation"
                    class="auth-label @error('matriculation') error @enderror">Matriculation</label>
                <input type="text" name="matriculation" id="matriculation"
                    class="auth-input @error('matriculation') error @enderror"
                    value="{{ old('matriculation', auth()->user()->matriculation) }}">
                @error('matriculation')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
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
</x-layouts.app>
