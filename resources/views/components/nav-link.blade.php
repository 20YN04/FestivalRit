@props(['href' => '#', 'active' => false])

@php
    $base = 'rounded-md px-3 py-1.5 text-sm font-medium transition';
    $state = $active
        ? 'bg-neutral-900 text-white'
        : 'text-neutral-700 hover:bg-neutral-100';
@endphp

<a href="{{ $href }}" {{ $attributes->class([$base, $state]) }}>
    {{ $slot }}
</a>
