<x-layouts.auth title="Réinitialiser le mot de passe">
    <x-success-message />
    <form action="{{ route('password.update') }}" method="POST" class="mx-auto grid w-full max-w-xl grid-cols-1 gap-6">
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <h1 class="text-2xl font-bold text-vintageRed-default">Réinitialiser le mot de passe</h1>
        @csrf
        <div class="auth-group">
            <label for="password" class="auth-label @error('password') error @enderror">Nouveau mot de passe</label>
            <input type="password" name="password" required class="auth-input @error('email') error @enderror">
            @error('password')
                <x-message variant="error">{{ $message }}</x-message>
            @enderror
        </div>
        <div class="auth-group">
            <label for="password_confirmation"
                class="auth-label @error('password_confirmation') error @enderror">Confirmation du mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="auth-input @error('password_confirmation') error @enderror" required>
            @error('password')
                <x-message variant="error">{{ $message }}</x-message>
            @enderror
        </div>
        <div class="space-y-4">
            <div class="space-y-2">
                <button type="submit" class="auth-button">Réinitialiser</button>
            </div>
        </div>
    </form>

</x-layouts.auth>
