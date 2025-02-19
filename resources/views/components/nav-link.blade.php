@props(['label', 'link', 'icon'])
@php
    $isActive = $link === request()->url();
@endphp
<a href="{{ $link }}" class="nav-link {{ $isActive ? 'active' : '' }}">
    <span><i data-feather="{{ $icon }}"></i></span>
    <span>{{ $label }}</span>
</a>
