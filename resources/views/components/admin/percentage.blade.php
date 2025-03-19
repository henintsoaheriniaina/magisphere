@props(['value' => 0])

@php
    $isPositive = $value >= 0;
    $bgColor = $isPositive ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600';
    $icon = $isPositive ? 'arrow-up' : 'arrow-down';
@endphp

<div class="{{ $bgColor }} flex items-center justify-center gap-1 rounded-full px-2 py-1 text-sm font-semibold">
    <i data-feather="{{ $icon }}" class="size-4"></i> {{ abs($value) }}%
</div>
