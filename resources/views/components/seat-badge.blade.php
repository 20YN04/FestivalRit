@props(['ride'])

@php
    $available = $ride->seats_available;
    $total = $ride->total_seats;
    $isFull = $ride->is_full;
    $almost = !$isFull && $available <= 1;

    $class = match (true) {
        $isFull => 'bg-red-100 text-red-700 ring-1 ring-red-200',
        $almost => 'bg-amber-100 text-amber-800 ring-1 ring-amber-200',
        default => 'bg-emerald-100 text-emerald-800 ring-1 ring-emerald-200',
    };
@endphp

<span {{ $attributes->class(['inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium', $class]) }}>
    @if ($isFull)
        Volzet ({{ $total }} {{ Str::plural('plaats', $total) }})
    @else
        {{ $available }} van {{ $total }} {{ Str::plural('plaats', $total) }} vrij
    @endif
</span>
