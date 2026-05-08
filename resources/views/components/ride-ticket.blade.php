@props(['ride'])

<a href="{{ route('rides.show', $ride) }}"
   class="group relative flex overflow-hidden rounded-3xl border border-white/7 bg-linear-to-br from-white/6 via-white/2 to-transparent p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-0.5 hover:border-flame-400/40 hover:shadow-[0_24px_60px_-30px_rgba(255,90,54,0.55)]">

    {{-- Left: trip details --}}
    <div class="flex flex-1 flex-col gap-2 pr-6">
        <div class="font-mono text-[10px] uppercase tracking-[0.35em] text-ink-400">
            {{ $ride->departure_city }} <span class="text-flame-400">→</span> {{ $ride->festival->name }}
        </div>
        <div class="display text-3xl uppercase leading-none text-ink-50 transition-colors duration-300 group-hover:text-gradient-flame">
            {{ $ride->driver_name }}
        </div>
        <div class="font-mono text-sm text-ink-300">
            {{ $ride->departure_time->isoFormat('ddd D MMM · HH:mm') }}
        </div>
        <div class="mt-auto pt-4">
            <x-seat-badge :ride="$ride" />
        </div>
    </div>

    {{-- Perforated divider --}}
    <div class="ticket-divider w-px self-stretch"></div>

    {{-- Right: seat counter --}}
    <div class="flex flex-col items-center justify-center gap-1 pl-6">
        <div class="font-mono text-[9px] uppercase tracking-[0.35em] text-ink-500">Vrij</div>
        <div class="display text-6xl leading-none text-gradient-flame">
            {{ $ride->seats_available }}
        </div>
        <div class="font-mono text-[10px] uppercase tracking-[0.3em] text-ink-400">
            van {{ $ride->total_seats }}
        </div>
    </div>

    {{-- Hover arrow --}}
    <span class="pointer-events-none absolute right-4 top-4 font-mono text-[10px] uppercase tracking-[0.3em] text-ink-600 transition-all duration-300 group-hover:right-3 group-hover:text-flame-400">
        ↗
    </span>
</a>
