<form action="{{ route('profile.profileImage') }}" enctype="multipart/form-data"
    class="mt-12 flex flex-col items-center justify-center gap-8 sm:flex-row sm:justify-start" method="POST"
    x-data="{ imagePreview: '{{ auth()->user()->image_url ?? asset('images/users/avatar.png') }}' }">
    @csrf
    @method('put')

    @error('image_url')
        <x-message variant="error">{{ $message }}</x-message>
    @enderror

    <div @class([
        'size-44 items-center justify-center overflow-hidden rounded-full border-2 bg-classic-white p-2 dark:bg-classic-black sm:size-52',
        'border-red-500' => $errors->has('image_url'),
        'border-classic-black dark:border-classic-white' => !$errors->has(
            'image_url'),
    ])>
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

        <label for="profileImageInput"
            class="profile-btn cursor-pointer border-vintageRed-default bg-vintageRed-default text-center text-classic-white">
            Modifier
        </label>
        <button type="submit" class="profile-btn border-classic-black dark:border-classic-white">
            Enregistrer
        </button>
    </div>
</form>
