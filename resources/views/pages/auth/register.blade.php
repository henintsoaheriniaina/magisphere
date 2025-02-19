<x-layouts.app title="Inscription">
    <div class="mt-10 flex min-h-[70vh] flex-col justify-center gap-10 md:gap-20">
        <h1 class="text-center text-2xl font-bold">Créer un compte</h1>
        <form action="" method="POST"
            class="mx-auto grid w-full max-w-full grid-cols-1 gap-6 md:mx-0 md:max-w-full md:grid-cols-2">
            @csrf
            <div class="auth-group">
                <label for="firstname" class="auth-label @error('firstname') error @enderror">Nom</label>
                <input type="text" name="firstname" id="firstname"
                    class="auth-input @error('firstname') error @enderror">
                @error('firstname')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="auth-group">
                <label for="lastname" class="auth-label @error('lastname') error @enderror">Prénoms</label>
                <input type="text" name="lastname" id="lastname"
                    class="auth-input @error('lastname') error @enderror">
                @error('lastname')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="auth-group">
                <label for="email" class="auth-label @error('email') error @enderror">Email</label>
                <input type="email" name="email" id="email" class="auth-input @error('email') error @enderror">
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="auth-group">
                <label for="matriculation"
                    class="auth-label @error('matriculation') error @enderror">Matriculation</label>
                <input type="text" name="matriculation" id="matriculation"
                    class="auth-input @error('matriculation') error @enderror">
                @error('matriculation')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="auth-group">
                <label for="password" class="auth-label @error('password') error @enderror">Mot de passe</label>
                <input type="password" name="password" id="password"
                    class="auth-input @error('password') error @enderror">
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="auth-group">
                <label for="password_confirmation"
                    class="auth-label @error('password_confirmation') error @enderror">Confirmez votre mot de
                    passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="auth-input @error('password_confirmation') error @enderror">
                @error('password_confirmation')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-4">
                <!-- Remember Me -->
                <div x-data="{ remember: false }" class="flex items-center space-x-2">
                    <div @click="remember = !remember" id="custom-checkbox"
                        class="flex h-5 w-5 cursor-pointer items-center justify-center rounded-sm border-2 border-gray-300">
                        <div x-show="remember" class="h-3 w-3 rounded-sm bg-vintageRed-default"></div>
                    </div>
                    <label for="custom-checkbox" class="cursor-pointer text-sm" @click="remember = !remember">Se
                        souvenir de
                        moi</label>
                    <input type="hidden" name="remember_token" :value="remember ? '1' : '0'">
                </div>
                <div class="space-y-2">
                    <button type="submit" class="auth-button">Inscription</button>
                    <p>Vous avez déjà un compte? <a href="{{ route('auth.login') }}" class="auth-link">Se connecter</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>
