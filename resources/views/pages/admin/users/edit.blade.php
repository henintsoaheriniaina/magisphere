<x-layouts.app title="Utilisateurs">
    <div class="lg:col-span-8">
        <x-back />
        <h1 class="my-10 text-3xl font-black md:text-4xl">Modifier</h1>
        <form action="{{ route('admin.users.update', $user) }}" method="POST"
            class="mx-auto grid w-full grid-cols-1 gap-6 md:mx-0 md:grid-cols-2">
            @csrf
            @method('put')
            <div class="auth-group">
                <label for="lastname" class="auth-label @error('lastname') error @enderror">Nom</label>
                <input type="text" name="lastname" id="lastname"
                    class="auth-input @error('lastname') error @enderror"
                    value="{{ old('lastname', $user->lastname) }}">
                @error('lastname')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="firstname" class="auth-label @error('firstname') error @enderror">Prénoms</label>
                <input type="text" name="firstname" id="firstname"
                    class="auth-input @error('firstname') error @enderror"
                    value="{{ old('firstname', $user->firstname) }}">
                @error('firstname')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="email" class="auth-label @error('email') error @enderror">Email</label>
                <input type="email" name="email" id="email" class="auth-input @error('email') error @enderror"
                    value="{{ old('email', $user->email) }}">
                @error('email')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            <div class="auth-group">
                <label for="matriculation"
                    class="auth-label @error('matriculation') error @enderror">Matriculation</label>
                <input type="text" name="matriculation" id="matriculation"
                    class="auth-input @error('matriculation') error @enderror"
                    value="{{ old('matriculation', $user->matriculation) }}">
                @error('matriculation')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>

            <div x-data="{
                open: false,
                selectedAffiliation: {
                    id: '{{ old('affiliation', $user->affiliation_id) }}',
                    label: '{{ old('affiliation') ? $affiliations->firstWhere('id', old('affiliation'))?->label : $user->affiliation?->label }}'
                }
            }" class="relative space-y-1">

                <label for="affiliation" class="auth-label @error('affiliation') error @enderror">Affiliation</label>

                <div class="cursor-pointer border-b-2 border-gray-300 border-b-classic-black bg-transparent bg-white p-2 py-2 outline-none transition-all duration-300 focus:bg-classic-black/10 focus:px-4 dark:border-b-classic-white dark:focus:bg-classic-white dark:focus:text-classic-black"
                    @click="open = !open">
                    <span
                        x-text="selectedAffiliation.label ? selectedAffiliation.label : 'Sélectionner une affiliation'"></span>
                </div>

                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute left-0 z-10 mt-2 w-full overflow-hidden rounded border-2 bg-classic-white dark:bg-classic-black">
                    @foreach ($affiliations as $affiliation)
                        <div @click="selectedAffiliation = { id: '{{ $affiliation->id }}', label: '{{ $affiliation->label }}' }; open = false"
                            class="dark:hover:text-classic-blacke flex cursor-pointer items-center p-2 hover:bg-classic-black hover:text-classic-white dark:hover:bg-classic-white dark:hover:text-classic-black">
                            <span>{{ $affiliation->label }}</span>
                        </div>
                    @endforeach
                </div>

                <input type="hidden" name="affiliation" x-model="selectedAffiliation.id">

                @error('affiliation')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
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
                <div class="cursor-pointer border-b-2 border-gray-300 border-b-classic-black bg-transparent bg-white p-2 py-2 outline-none transition-all duration-300 focus:bg-classic-black/10 focus:px-4 dark:border-b-classic-white dark:focus:bg-classic-white dark:focus:text-classic-black"
                    @click="open = !open">
                    <span
                        x-text="selectedRoles.length ? selectedRoles.map(role => roleLabels[role]).join(', ') : 'Sélectionner des rôles'"></span>
                </div>

                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute left-0 z-10 mt-2 w-full overflow-hidden rounded border-2 bg-classic-white dark:bg-classic-black">
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

            <div class="space-y-4">
                <button type="submit" class="auth-button">Modifier</button>
            </div>
        </form>
    </div>
</x-layouts.app>
