<x-layouts.auth title="Connexion">

    <form action="{{ route('login') }}" method="POST" class="mx-auto grid w-full max-w-xl grid-cols-1 gap-6">
        <h1 class="text-2xl font-bold text-vintageRed-default">Se connecter à votre compte</h1>
        @csrf
        <div class="auth-group">
            <label for="email" class="auth-label @error('email') error @enderror">Email</label>
            <input type="email" name="email" id="email" class="auth-input @error('email') error @enderror">
            @error('email')
                <x-message variant="error">{{ $message }}</x-message>
            @enderror
        </div>
        <div class="auth-group">
            <label for="password" class="auth-label @error('password') error @enderror">Mot de passe</label>
            <input type="password" name="password" id="password" class="auth-input @error('password') error @enderror">
            @error('password')
                <x-message variant="error">{{ $message }}</x-message>
            @enderror
            @error('credentials')
                <x-message variant="error">{{ $message }}</x-message>
            @enderror
        </div>

        <div class="space-y-4">
            <div x-data="{ remember: false }" class="flex items-center space-x-2">
                <div @click="remember = !remember" id="custom-checkbox"
                    class="flex h-5 w-5 cursor-pointer items-center justify-center rounded-sm border-2 border-gray-300">
                    <div x-show="remember" class="h-3 w-3 rounded-sm bg-vintageRed-default"></div>
                </div>
                <label for="custom-checkbox" class="cursor-pointer text-sm" @click="remember = !remember">Se
                    souvenir de
                    moi</label>
                <input type="hidden" name="remember" :value="remember ? '1' : '0'">
            </div>
            <div class="space-y-2">
                <button type="submit" class="auth-button">Connexion</button>
                <p>Vous n'avez pas de compte? <a href="{{ route('register') }}" class="auth-link">S'inscrire</a>
                </p>
            </div>
        </div>
    </form>

</x-layouts.auth>
