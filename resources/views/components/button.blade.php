@props(['variant' => 'primary', 'href' => null, 'type' => 'button'])

@php
    $base = 'inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2';
    $variants = [
        'primary' => 'bg-neutral-900 text-white hover:bg-neutral-800 focus:ring-neutral-900',
        'secondary' => 'bg-white text-neutral-900 border border-neutral-300 hover:bg-neutral-50 focus:ring-neutral-300',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-600',
    ];
    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </button>
@endif
