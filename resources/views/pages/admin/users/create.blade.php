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
            <div x-data="{ open: false, selectedAffiliation: '' }" class="relative space-y-1">
                <label for="affiliation" class="auth-label @error('affiliation') error @enderror">Affiliation</label>

                <div class="cursor-pointer border-b-2 border-b-classic-black bg-transparent p-2 outline-none transition-all duration-300 dark:border-b-classic-white"
                    @click="open = !open">
                    <span x-text="selectedAffiliation ? selectedAffiliation : 'Sélectionner une affiliation'"></span>
                </div>
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute left-0 z-10 mt-2 w-full overflow-hidden rounded border-2 bg-classic-white dark:bg-classic-black">
                    @foreach ($affiliations as $affiliation)
                        <div @click="selectedAffiliation = '{{ $affiliation->label }}'; open = false"
                            class="dark:hover:text-classic-blacke flex cursor-pointer items-center p-2 hover:bg-classic-black hover:text-classic-white dark:hover:bg-classic-white dark:hover:text-classic-black">
                            <span>{{ $affiliation->label }}</span>
                        </div>
                    @endforeach
                </div>

                <select id="affiliation" name="affiliation" class="hidden">
                    <option value="" selected></option>
                    @foreach ($affiliations as $affiliation)
                        <option value="{{ $affiliation->id }}"
                            x-bind:selected="selectedAffiliation === '{{ $affiliation->label }}'">
                            {{ $affiliation->label }}
                        </option>
                    @endforeach
                </select>

                @error('affiliation')
                    <div class="mt-auto">
                        <x-message variant="error">{{ $message }}</x-message>
                    </div>
                @enderror
            </div>
            @role('admin')
                <div x-data="{
                    open: false,
                    selectedRoles: [],
                    toggleRole(role, label) {
                        if (this.selectedRoles.includes(role)) {
                            this.selectedRoles = this.selectedRoles.filter(r => r !== role);
                        } else {
                            this.selectedRoles.push(role);
                        }
                    },
                    roleLabels: {
                        user: 'Utilisateur',
                        moderator: 'Modérateur',
                        verificator: 'Vérificateur',
                        admin: 'Administrateur'
                    }
                }" class="relative space-y-1">
                    <label for="roles" class="auth-label">Rôles :</label>
                    <div class="cursor-pointer border-b-2 border-b-classic-black bg-transparent p-2 outline-none transition-all duration-300 dark:border-b-classic-white"
                        @click="open = !open">
                        <span
                            x-text="selectedRoles.length ? selectedRoles.map(role => roleLabels[role]).join(', ') : 'Sélectionner des rôles'"></span>
                    </div>

                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute left-0 z-10 w-full overflow-hidden rounded border-2 bg-classic-white dark:bg-classic-black">
                        <template
                            x-for="role in [{value: 'user', label: 'Utilisateur'}, {value: 'moderator', label: 'Modérateur'}, {value: 'verificator', label: 'Vérificateur'}, {value: 'admin', label: 'Administrateur'}]"
                            :key="role.value">
                            <div @click="toggleRole(role.value, role.label)"
                                class="flex cursor-pointer items-center p-2 hover:bg-classic-black hover:text-classic-white dark:hover:bg-classic-white dark:hover:text-classic-black">
                                <input type="checkbox" class="mr-2" :value="role.value" x-model="selectedRoles">
                                <span x-text="role.label"></span>
                            </div>
                        </template>
                    </div>

                    <select name="roles[]" id="roles" multiple class="hidden">
                        <template x-for="role in selectedRoles" :key="role">
                            <option :value="role" selected x-text="role"></option>
                        </template>
                    </select>

                    @error('roles')
                        <div class="mt-auto">
                            <x-message variant="error">{{ $message }}</x-message>
                        </div>
                    @enderror
                </div>
            @endrole
            @if (!auth()->user()->hasRole('admin'))
                <div class=""></div>
                <div class="hidden">
                    <select name="roles[]" id="role" multiple>
                        <option value="user" selected>Utilisateur</option>
                    </select>
                </div>
            @endif

            <div class="space-y-4">
                <button type="submit" class="auth-button">Créer</button>
            </div>
        </form>
    </div>
</x-layouts.app>
