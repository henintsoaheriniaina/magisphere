@props(['variant' => 'success'])

@php
    $variantClasses = [
        'success' => 'bg-green-500 text-classic-white dark:text-classic-black',
        'error' => 'bg-vintageRed-default text-classic-white dark:text-classic-black',
    ];

    $classes = $variantClasses[$variant] ?? $variantClasses['success'];
@endphp

<div {{ $attributes->merge(['class' => "mt-6 rounded-lg font-semibold {$classes} px-4 py-2 text-center"]) }}>
    {{ $slot }}
</div>
