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
    @csrf
    <div class="auth-group">
        <textarea name="description" id="description" class="@error('description') error @enderror auth-input" rows="4">{{ old('description') }}</textarea>
        @error('description')
            <x-message variant="error">{{ $message }}</x-message>
        @enderror
    </div>

    <div class="flex space-x-4">
        <button type="button" class="auth-button" @click.prevent="$refs.imageInput.click()"><svg
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
        </button>
        <button type="button" class="auth-button" @click.prevent="$refs.videoInput.click()"><svg
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
        </button>
        <button type="button" class="auth-button" @click.prevent="$refs.documentInput.click()"><svg
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
        </button>
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-1 gap-4 pr-20 sm:grid-cols-3">
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
                    <button type="button" class="auth-button absolute -right-3 -top-3" @click="removeFile(index)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.3" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </template>
        </div>
    </div>


</form>
