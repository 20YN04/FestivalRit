@props(['href' => '#', 'active' => false])

@php
    $base = 'relative rounded-full px-4 py-2 text-sm font-medium tracking-tight transition-all duration-200';
    $state = $active
        ? 'bg-ink-50 text-ink-950 shadow-[0_0_24px_-6px] shadow-flame-400/60'
        : 'text-ink-300 hover:text-ink-50 hover:bg-white/[0.06]';
@endphp

<a href="{{ $href }}" {{ $attributes->class([$base, $state]) }}>
    {{ $slot }}
</a>
