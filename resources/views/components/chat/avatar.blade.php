@props(['src' => null])
<div
    {{ $attributes->merge(['class' => 'shrink-0  overflow-hidden rounded-full border border-gray-200 dark:border-secondary-500 w-10 h-10 text-base']) }}>
    <img @class([
        'shrink-0 w-full h-full object-cover object-center rounded-full',
    ]) src="{{ $src ?? asset('images/users/avatar.png') }}" />
</div>
