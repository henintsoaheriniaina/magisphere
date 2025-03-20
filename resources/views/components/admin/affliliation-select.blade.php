@props(['affiliations'])
<div x-data="{ open: false, selectedAffiliation: '' }" class="relative space-y-1">
    <label for="affiliation" class="auth-label @error('affiliation') error @enderror">Affiliation</label>

    <div class="cursor-pointer border-b-2 border-gray-300 border-b-classic-black bg-transparent bg-white p-2 py-2 outline-none transition-all duration-300 focus:bg-classic-black/10 focus:px-4 dark:border-b-classic-white dark:focus:bg-classic-white dark:focus:text-classic-black"
        @click="open = !open">
        <span x-text="selectedAffiliation ? selectedAffiliation : 'Sélectionner une affiliation'"></span>
    </div>

    <div x-show="open" @click.away="open = false" x-transition
        class="absolute left-0 z-10 mt-2 w-full overflow-hidden rounded border-2 bg-classic-white dark:bg-classic-black">
        @foreach ($affiliations as $affiliation)
            <div @click="selectedAffiliation = '{{ $affiliation->label }}'; open = false"
                class="flex cursor-pointer items-center p-2 hover:bg-vintageRed-default hover:text-classic-white">
                <span>{{ $affiliation->label }}</span>
            </div>
        @endforeach
    </div>

    <!-- Champ caché pour lier la sélection avec le backend -->
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
