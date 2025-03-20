@props(['value' => 0])

@php
    $isPositive = $value >= 0;
    $bgColor = $isPositive ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600';
@endphp

<div class="{{ $bgColor }} flex items-center justify-center gap-1 rounded-full px-2 py-1 text-sm font-semibold">
    @if ($isPositive)
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3" stroke="currentColor"
            class="mr-1 size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
        </svg>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
            stroke="currentColor" class="mr-1 size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
        </svg>
    @endif
    {{ abs($value) }}%
</div>
