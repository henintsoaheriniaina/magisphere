<x-layouts.auth title="Vérification de l'email">
    <div class="flex flex-col items-center space-y-6 rounded-lg border-2 p-12 text-center">
        <x-success-message />
        <div class="">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="size-32 sm:size-52">
        </div>
        <h1 class="text-2xl font-semibold text-vintageRed-default">
            Vérification de votre adresse email
        </h1>
        <p class="text-lg text-classic-black dark:text-classic-white">
            Cliquez sur le bouton ci-dessous pour recevoir un email de vérification à <span
                class="font-semibold">{{ auth()->user()->email }}</span>.
        </p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="auth-button rounded-lg bg-vintageRed-default px-6 py-3 font-medium text-white hover:bg-vintageRed-dark">
                Envoyer l'email de vérification
            </button>
        </form>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Assurez-vous de vérifier votre dossier spam si vous ne trouvez pas l'email.
        </p>
    </div>
</x-layouts.auth>
