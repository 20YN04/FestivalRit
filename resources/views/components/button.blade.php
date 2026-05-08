@props(['variant' => 'primary', 'href' => null, 'type' => 'button', 'size' => 'md'])

@php
    $sizes = [
        'sm' => 'px-4 py-2 text-xs',
        'md' => 'px-5 py-2.5 text-sm',
        'lg' => 'px-7 py-3.5 text-base',
    ];

    $variants = [
        'primary' => 'bg-linear-to-r from-flame-500 via-flame-400 to-magenta-500 text-ink-950 shadow-[0_8px_32px_-8px] shadow-flame-500/60 hover:-translate-y-0.5 hover:shadow-[0_12px_40px_-8px] hover:shadow-magenta-500/60',
        'secondary' => 'border border-white/10 bg-white/4 text-ink-100 backdrop-blur-md hover:border-white/20 hover:bg-white/8',
        'ghost' => 'text-ink-300 hover:bg-white/5 hover:text-ink-50',
        'danger' => 'border border-flame-500/40 bg-flame-500/10 text-flame-300 hover:bg-flame-500/20 hover:text-flame-200',
        'acid' => 'bg-acid-400 text-ink-950 shadow-[0_0_28px_-6px] shadow-acid-400/70 hover:bg-acid-300 hover:shadow-[0_0_36px_-4px] hover:shadow-acid-400',
    ];

    $base = 'inline-flex items-center justify-center gap-2 rounded-full font-semibold tracking-tight uppercase transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-ink-950 focus:ring-flame-400/40 disabled:pointer-events-none disabled:opacity-50';

    $classes = $base . ' ' . ($sizes[$size] ?? $sizes['md']) . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>{{ $slot }}</button>
@endif
