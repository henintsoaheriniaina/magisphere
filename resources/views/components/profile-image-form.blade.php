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
            class="absolute bottom-0 left-0 right-0 top-0 m-2 flex items-center justify-center rounded-full bg-vintageRed-default/50 p-2">
            <i data-feather="upload" class="size-5"></i>
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
            :class="{ 'opacity-100 cursor-pointer': hasImage, 'opacity-50 cursor-not-allowed': !hasImage }"
            @click.prevent="if (!hasImage) return false;">
            Supprimer
        </a>
    </div>
</form>
