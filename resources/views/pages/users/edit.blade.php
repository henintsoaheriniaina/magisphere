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
        <form action="{{ route('profile.updatePassword') }}"
            class="md flex flex-col items-center justify-center gap-8 rounded-lg border-2 border-classic-black p-6 dark:border-classic-white sm:items-start sm:justify-start"
            method="POST">
            @csrf
            @method('put')
            <h1 class="text-center text-2xl font-bold sm:text-left">Modifier votre mot de passe</h1>
            <div class="auth-group w-full max-w-lg">
                <label for="old_password" class="auth-label @error('old_password') error @enderror">Mot de
                    passe</label>
                <input type="password" name="old_password" id="old_password"
                    class="auth-input @error('old_password') error @enderror">
                @error('old_password')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group w-full max-w-lg">
                <label for="password" class="auth-label @error('password') error @enderror">Nouveau mot de passe</label>
                <input type="password" name="password" id="password"
                    class="auth-input @error('password') error @enderror">
                @error('password')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>

            <div class="auth-group w-full max-w-lg">
                <label for="password_confirmation" class="auth-label @error('password') error @enderror">Confirmez votre
                    nouveau mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="auth-input @error('password') error @enderror">
                @error('password')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                <button type="submit" class="auth-button">Enregistrer</button>
                <a href="{{ route('password.request') }}" class="auth-link">Mot de passe oublié?</a>
            </div>
        </form>
    </div>
</x-layouts.app>
