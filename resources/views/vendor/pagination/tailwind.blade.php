@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigation de pagination" class="flex items-center justify-between">
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex cursor-default items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500">
                    Précédent
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="focus:outline-hidden focus:ring-3 relative inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                    Précédent
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="focus:outline-hidden focus:ring-3 relative ml-3 inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                    Suivant
                </a>
            @else
                <span
                    class="relative ml-3 inline-flex cursor-default items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500">
                    Suivant
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm leading-5 text-gray-700">
                    Affichage
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        à
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    sur
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    résultats
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-lg rtl:flex-row-reverse">
                    {{-- Lien vers la page précédente --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="Précédent">
                            <span
                                class="relative inline-flex cursor-default items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium leading-5 text-gray-500"
                                aria-hidden="true">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="focus:outline-hidden focus:ring-3 relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium leading-5 text-gray-500 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-400 focus:z-10 focus:border-blue-300 active:bg-gray-100 active:text-gray-500"
                            aria-label="Précédent">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Éléments de pagination --}}
                    @foreach ($elements as $element)
                        {{-- Séparateur "trois points" --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Tableau des liens --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-500">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="focus:outline-hidden focus:ring-3 relative -ml-px inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 active:bg-gray-100 active:text-gray-700"
                                        aria-label="Aller à la page {{ $page }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Lien vers la page suivante --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="focus:outline-hidden focus:ring-3 relative -ml-px inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium leading-5 text-gray-500 ring-gray-300 transition duration-150 ease-in-out hover:text-gray-400 focus:z-10 focus:border-blue-300 active:bg-gray-100 active:text-gray-500"
                            aria-label="Suivant">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4-4a1 1 0 010 1.414l-4-4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="Suivant">
                            <span
                                class="relative -ml-px inline-flex cursor-default items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium leading-5 text-gray-500"
                                aria-hidden="true">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4-4a1 1 0 010 1.414l-4-4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
