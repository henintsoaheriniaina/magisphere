<x-layouts.app title="Publier">

    <div class="lg:col-span-8">
        <x-back />
        <h1 class="my-10 text-3xl font-black md:text-4xl">Modifier une Publication</h1>
        <form action="{{ route('posts.update', $post) }}" method="POST"
            class="mx-auto grid w-full grid-cols-1 gap-6 rounded-lg border-2 border-classic-black p-6 dark:border-classic-white"
            x-data="{
                isLoading: false,
                submitForm(event) {
                    this.isLoading = true;
                    event.target.submit();
                },
                open: false,
                selectedCategory: '',
            }" @submit.prevent="submitForm">
            @csrf
            @method('patch')
            <div class="auth-group">
                <label for="description" class="auth-label @error('description') error @enderror">Description</label>
                <textarea name="description" id="description" class="@error('description') error @enderror auth-input" rows="4">{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <x-message variant="error">{{ $message }}</x-message>
                @enderror
            </div>
            @role('admin|moderator')
                <div class="relative space-y-1">
                    <label for="category" class="auth-label @error('category') error @enderror">Catégorie</label>

                    <div class="cursor-pointer border-b-2 border-b-classic-black bg-transparent py-2 outline-none transition-all duration-300 dark:border-b-classic-white"
                        @click="open = !open">
                        <span
                            x-text="selectedCategory === 'post' ? 'Publication' : (selectedCategory === 'announcement' ? 'Annonce' : 'Sélectionner une catégorie')"></span>
                    </div>
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute left-0 z-10 mt-2 w-full overflow-hidden rounded border-2 bg-classic-white dark:bg-classic-black">
                        <div @click="selectedCategory = 'post'; open = false"
                            class="dark:hover:text-classic-blacke flex cursor-pointer items-center p-2 hover:bg-classic-black hover:text-classic-white dark:hover:bg-classic-white dark:hover:text-classic-black">
                            <span>Publication</span>
                        </div>
                        <div @click="selectedCategory = 'announcement'; open = false"
                            class="dark:hover:text-classic-blacke flex cursor-pointer items-center p-2 hover:bg-classic-black hover:text-classic-white dark:hover:bg-classic-white dark:hover:text-classic-black">
                            <span>Annonce</span>
                        </div>
                    </div>

                    <select id="category" name="category" class="hidden">
                        <option value="" selected></option>
                        <option value="post" x-bind:selected="selectedCategory === 'post'">
                            Publication
                        </option>
                        <option value="announcement" x-bind:selected="selectedCategory === 'announcement'">
                            Annonce
                        </option>
                    </select>

                    @error('category')
                        <div class="mt-auto">
                            <x-message variant="error">{{ $message }}</x-message>
                        </div>
                    @enderror
                </div>
            @endrole
            <div class="space-y-4">
                <button type="submit" class="auth-button min-w-32" :disabled="isLoading">
                    <template x-if="isLoading">
                        <svg class="mx-auto h-5 w-5 animate-spin text-classic-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </template>
                    <template x-if="!isLoading">
                        <span>Enregistrer</span>
                    </template>
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
