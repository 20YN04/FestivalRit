@props(['festival', 'size' => 'md'])

@php
    $themes = [
        ['from' => '#ff5a36', 'via' => '#ff2e7e', 'to' => '#7a1aff'],
        ['from' => '#4ee0ff', 'via' => '#2a7bff', 'to' => '#0d2eaa'],
        ['from' => '#c6ff3d', 'via' => '#28d76b', 'to' => '#0c5e3b'],
        ['from' => '#ffb54b', 'via' => '#ff5a36', 'to' => '#9b1414'],
        ['from' => '#ff5fa3', 'via' => '#a82dff', 'to' => '#1d066b'],
        ['from' => '#5be3a0', 'via' => '#1aa0c8', 'to' => '#1c2670'],
        ['from' => '#fff04a', 'via' => '#ff5a36', 'to' => '#420f44'],
        ['from' => '#e4e4ee', 'via' => '#9b9bb0', 'to' => '#0c0c14'],
    ];

    $theme = $themes[abs(crc32($festival->name)) % count($themes)];

    $heights = [
        'sm' => 'h-32',
        'md' => 'h-48',
        'lg' => 'h-64',
        'xl' => 'h-[28rem]',
    ];

    $titleSize = [
        'sm' => 'text-2xl',
        'md' => 'text-4xl',
        'lg' => 'text-6xl',
        'xl' => 'text-7xl md:text-9xl',
    ];

    $heightClass = $heights[$size] ?? $heights['md'];
    $titleClass = $titleSize[$size] ?? $titleSize['md'];
@endphp

<div
    {{ $attributes->class(['relative isolate overflow-hidden rounded-3xl', $heightClass]) }}
    style="background: linear-gradient(135deg, {{ $theme['from'] }} 0%, {{ $theme['via'] }} 50%, {{ $theme['to'] }} 100%);"
>
    {{-- light bloom --}}
    <div class="absolute inset-0 mix-blend-overlay opacity-50" style="background-image: radial-gradient(circle at 25% 15%, rgba(255,255,255,0.7) 0%, transparent 50%), radial-gradient(circle at 75% 85%, rgba(0,0,0,0.5) 0%, transparent 50%);"></div>

    {{-- diagonal stripes --}}
    <div class="absolute inset-0 opacity-25" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 14px, rgba(255,255,255,0.06) 14px, rgba(255,255,255,0.06) 15px);"></div>

    {{-- grain overlay --}}
    <div class="scanlines absolute inset-0 opacity-60"></div>

    {{-- corner ticks --}}
    <div class="pointer-events-none absolute left-5 top-5 font-mono text-[9px] uppercase tracking-[0.3em] text-white/70">
        // {{ str_pad((string) $festival->id, 3, '0', STR_PAD_LEFT) }}
    </div>
    <div class="pointer-events-none absolute right-5 top-5 font-mono text-[9px] uppercase tracking-[0.3em] text-white/70">
        Festival
    </div>

    <div class="absolute inset-x-0 bottom-0 p-5 md:p-7">
        <div class="font-mono text-[10px] uppercase tracking-[0.4em] text-white/80">
            {{ $festival->location }}
        </div>
        <div class="display mt-2 uppercase leading-[0.85] text-white drop-shadow-[0_4px_24px_rgba(0,0,0,0.5)] {{ $titleClass }}">
            {{ $festival->name }}
        </div>
    </div>
</div>
