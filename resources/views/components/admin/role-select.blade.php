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
        class="absolute left-0 z-10 mt-2 w-full overflow-hidden rounded border-2">
        <template
            x-for="role in [{value: 'user', label: 'Utilisateur'}, {value: 'moderator', label: 'Modérateur'}, {value: 'verificator', label: 'Vérificateur'}, {value: 'admin', label: 'Administrateur'}]"
            :key="role.value">
            <div @click="toggleRole(role.value, role.label)" class="flex cursor-pointer items-center p-2">
                <input type="checkbox" class="mr-2" :value="role.value" x-model="selectedRoles">
                <span x-text="role.label"></span>
            </div>
        </template>
    </div>

    <!-- Input caché pour conserver la logique backend -->
    <select name="roles[]" id="roles" multiple class="hidden">
        <template x-for="role in selectedRoles" :key="role">
            <option :value="role" selected x-text="role"></option>
        </template>
    </select>
</div>
