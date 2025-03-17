<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
    class="mx-auto grid w-full grid-cols-1 gap-6 rounded-lg border-2 border-classic-black p-6 dark:border-classic-white"
    x-data="{
        files: @json(old('files', [])),
        isLoading: false,
        handleFiles(event) {
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.files.push({ name: file.name, type: file.type, url: e.target.result, file: file });
                };
                reader.readAsDataURL(file);
            });
        },
        removeFile(index) {
            this.files.splice(index, 1);
        },
        submitForm(event) {
            this.isLoading = true;
            event.target.submit();
        }
    }" @submit.prevent="submitForm">
    <h1 class="text-2xl font-bold text-vintageRed-default">Créer une nouvelle publication</h1>
    @csrf
    <div class="auth-group">
        <textarea name="description" id="description" class="@error('description') error @enderror auth-input" rows="4">{{ old('description') }}</textarea>
        @error('description')
            <x-message variant="error">{{ $message }}</x-message>
        @enderror
    </div>

    <div class="flex space-x-4">
        <button type="button" class="auth-button" @click.prevent="$refs.imageInput.click()"><i
                data-feather="image"></i></button>
        <button type="button" class="auth-button" @click.prevent="$refs.videoInput.click()"><i
                data-feather="video"></i></button>
        <button type="button" class="auth-button" @click.prevent="$refs.documentInput.click()"><i
                data-feather="file-text"></i></button>
    </div>

    <input type="file" name="files[]" accept="image/*" x-ref="imageInput" multiple class="hidden"
        @change="handleFiles">
    <input type="file" name="files[]" accept="video/*" x-ref="videoInput" multiple class="hidden"
        @change="handleFiles">
    <input type="file" name="files[]" accept=".pdf,.doc,.docx,.txt" x-ref="documentInput" multiple class="hidden"
        @change="handleFiles">
    <div class="space-y-4">
        <button type="submit" class="auth-button min-w-32" :disabled="isLoading">
            <template x-if="isLoading">
                <svg class="mx-auto h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </template>
            <template x-if="!isLoading">
                <span>Publier</span>
            </template>
        </button>
    </div>
    <div x-show="files.length" class="mt-4 space-y-2">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">Fichiers sélectionnés :</h2>
            <button type="button" class="auth-button mt-2 bg-vintageRed-default hover:bg-vintageRed-dark"
                @click="files = []">
                <i data-feather="trash"></i>
            </button>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <template x-for="(file, index) in files" :key="index">
                <div class="relative rounded-lg border p-2 dark:border-classic-white">
                    <template x-if="file.type.includes('image')">
                        <img :src="file.url" class="size-32 rounded-lg object-cover object-center">
                    </template>
                    <template x-if="file.type.includes('video')">
                        <video class="h-24 w-24 rounded-lg" controls>
                            <source :src="file.url" type="video/mp4">
                        </video>
                    </template>
                    <template
                        x-if="file.type.includes('pdf') || file.type.includes('word') || file.type.includes('text')">
                        <p class="text-gray-700 dark:text-gray-300" x-text="file.name"></p>
                    </template>

                    <button type="button" class="auth-button absolute -right-2 -top-2" @click="removeFile(index)">
                        ✕
                    </button>
                </div>
            </template>
        </div>
    </div>


</form>
