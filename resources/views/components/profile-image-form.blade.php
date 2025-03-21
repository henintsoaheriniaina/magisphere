<form action="{{ route('profile.updateProfileImage') }}" enctype="multipart/form-data"
    class="mt-12 flex flex-col items-center justify-center gap-8 sm:flex-row sm:justify-start" method="POST"
    x-data="{
        imagePreview: '{{ auth()->user()->image_url ?? asset('images/users/avatar.png') }}',
        hasImage: {{ auth()->user()->image_url ? 'true' : 'false' }},
    }">
    @csrf
    @method('put')

    @error('image_url')
        <x-message variant="error">{{ $message }}</x-message>
    @enderror

    <div @class([
        'relative size-44 sm:size-52 rounded-full border-2 bg-classic-white p-2 dark:bg-classic-black cursor-pointer flex items-center justify-center overflow-hidden',
        'border-red-500' => $errors->has('image_url'),
        'border-classic-black dark:border-classic-white' => !$errors->has(
            'image_url'),
    ]) @click="document.getElementById('profileImageInput').click()">
        <div
            class="absolute bottom-0 left-0 right-0 top-0 m-2 flex items-center justify-center rounded-full bg-vintageRed-default/40 p-2 text-classic-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
            </svg>

        </div>
        <img :src="imagePreview" alt="Profile Image" class="h-full w-full rounded-full object-cover">
    </div>

    <div class="flex flex-col gap-4">
        <input type="file" name="image_url" id="profileImageInput" accept="image/*" class="hidden"
            @change="let file = $event.target.files[0];
                     if (file) {
                         let reader = new FileReader();
                         reader.onload = e => imagePreview = e.target.result;
                         reader.readAsDataURL(file);
                     }">
        <button type="submit" class="profile-btn border-vintageRed-default bg-vintageRed-default text-classic-white">
            Enregistrer
        </button>
        <a href="{{ route('profile.deleteProfileImage') }}"
            class="profile-btn border-classic-black text-classic-black opacity-50 dark:border-classic-white dark:text-classic-white"
            :class="{ 'opacity-100 cursor-pointer': hasImage, 'opacity-50 cursor-not-allowed': !hasImage }">
            Supprimer
        </a>
    </div>
</form>
