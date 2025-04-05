<x-layouts.auth title="Mot de passe oublié">
    <form action="{{ route('password.email') }}" method="POST" class="mx-auto grid w-full max-w-xl grid-cols-1 gap-6">
        <h1 class="text-2xl font-bold text-vintageRed-default">Mot de passe oublié</h1>
        @csrf
        <div class="auth-group">
            <label for="email" class="auth-label @error('email') error @enderror">Email</label>
            <input type="email" name="email" required class="auth-input @error('email') error @enderror">
            @error('email')
                <x-message variant="error">{{ $message }}</x-message>
            @enderror
            <x-success-message />

        </div>
        <div class="space-y-4">
            <div class="space-y-2">
                <button type="submit" class="auth-button">Réinitialiser</button>
            </div>
        </div>
    </form>

</x-layouts.auth>
