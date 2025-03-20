@props(['label' => '', 'link'])
@php
    $isActive = $link === request()->url();
@endphp
<a href="{{ $link }}" class="nav-link {{ $isActive ? 'active' : '' }}">
    <span>{{ $slot }}</span>
    @if ($label)
        <span>{{ $label }}</span>
    @endif
</a>
