    <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('index') }}"
        class="my-4 flex items-center gap-2 font-semibold text-vintageRed-default">
        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </span> Retour
    </a>
