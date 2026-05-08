@props(['ride'])

@php
    $available = $ride->seats_available;
    $total = $ride->total_seats;
    $isFull = $ride->is_full;
    $almost = !$isFull && $available <= 1;
@endphp

@if ($isFull)
    <span {{ $attributes->class(['inline-flex items-center gap-2 rounded-full border border-flame-500/30 bg-flame-500/10 px-3 py-1.5 font-mono text-[10px] uppercase tracking-[0.25em] text-flame-300']) }}>
        <span class="block h-1.5 w-1.5 rounded-full bg-flame-400"></span>
        Volzet · {{ $total }} {{ Str::plural('plaats', $total) }}
    </span>
@elseif ($almost)
    <span {{ $attributes->class(['inline-flex items-center gap-2 rounded-full border border-magenta-400/30 bg-magenta-500/10 px-3 py-1.5 font-mono text-[10px] uppercase tracking-[0.25em] text-magenta-300']) }}>
        <span class="block h-1.5 w-1.5 animate-pulse rounded-full bg-magenta-400 shadow-[0_0_10px] shadow-magenta-400"></span>
        Laatste plaats
    </span>
@else
    <span {{ $attributes->class(['inline-flex items-center gap-2 rounded-full border border-acid-400/30 bg-acid-400/10 px-3 py-1.5 font-mono text-[10px] uppercase tracking-[0.25em] text-acid-300']) }}>
        <span class="block h-1.5 w-1.5 rounded-full bg-acid-400 shadow-[0_0_10px] shadow-acid-400"></span>
        {{ $available }} van {{ $total }} vrij
    </span>
@endif
