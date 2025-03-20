<x-layouts.app title="Utilisateurs">
    <div class="lg:col-span-8">
        <x-back />
        <h1 class="my-10 text-3xl font-black md:text-4xl">Créer un utilisateur</h1>
        {{-- Créer un utilisateur --}}
        <form action="{{ route('admin.users.store') }}" method="POST"
            class="mx-auto grid w-full grid-cols-1 gap-6 md:mx-0 md:grid-cols-2">
            @csrf
            <div class="auth-group">
                <label for="lastname" class="auth-label @error('lastname') error @enderror">Nom</label>
                <input type="text" name="lastname" id="lastname"
                    class="auth-input @error('lastname') error @enderror" value="{{ old('lastname') }}">
                @error('lastname')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="firstname" class="auth-label @error('firstname') error @enderror">Prénoms</label>
                <input type="text" name="firstname" id="firstname"
                    class="auth-input @error('firstname') error @enderror" value="{{ old('firstname') }}">
                @error('firstname')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="email" class="auth-label @error('email') error @enderror">Email</label>
                <input type="email" name="email" id="email" class="auth-input @error('email') error @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="matriculation"
                    class="auth-label @error('matriculation') error @enderror">Matriculation</label>
                <input type="text" name="matriculation" id="matriculation"
                    class="auth-input @error('matriculation') error @enderror" value="{{ old('matriculation') }}">
                @error('matriculation')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="password" class="auth-label @error('password') error @enderror">Mot de passe</label>
                <input type="password" name="password" id="password"
                    class="auth-input @error('password') error @enderror">
                @error('password')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="password_confirmation" class="auth-label @error('password') error @enderror">Confirmez
                    le mot de
                    passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="auth-input @error('password') error @enderror">
                @error('password')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>

            <div class="auth-group">
                <label for="affiliation" class="auth-label @error('affiliation') error @enderror">Affiliation</label>
                <select id="affiliation" name="affiliation" autocomplete="affiliation"
                    class="@error('affiliation') error @enderror auth-input select">
                    <option value="" selected></option>
                    @foreach ($affiliations as $affiliation)
                        <option value="{{ $affiliation->id }}"
                            {{ old('affiliation') == $affiliation->id ? 'selected' : '' }}>
                            {{ $affiliation->label }}
                        </option>
                    @endforeach
                </select>
                @error('affiliation')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <x-admin.role-select />


            <div class="space-y-4">
                <button type="submit" class="auth-button">Créer</button>
            </div>
        </form>
    </div>
</x-layouts.app>
