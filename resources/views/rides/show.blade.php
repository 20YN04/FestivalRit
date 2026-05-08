<x-layout :title="'Rit van ' . $ride->driver_name">
    <a href="{{ route('rides.index') }}" class="mb-8 inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.35em] text-ink-400 transition hover:text-flame-400">
        ← Alle ritten
    </a>

    <section class="animate-hero mb-12">
        <div class="font-mono text-xs uppercase tracking-[0.4em] text-flame-400">// Boarding pass</div>
        <h1 class="display mt-3 text-7xl uppercase leading-[0.85] text-ink-50 md:text-9xl">
            {{ $ride->driver_name }}
        </h1>
        <p class="mt-6 max-w-2xl text-lg text-ink-300">
            Vertrekt vanuit
            <span class="text-ink-50">{{ $ride->departure_city }}</span>
            richting
            <a href="{{ route('festivals.show', $ride->festival) }}" class="font-semibold text-gradient-flame hover:underline">
                {{ $ride->festival->name }}
            </a>.
        </p>
    </section>

    <div class="grid gap-6 md:grid-cols-3">
        <div class="space-y-6 md:col-span-2">
            <x-card eyebrow="Reisinfo">
                <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
                    <div>
                        <div class="font-mono text-[10px] uppercase tracking-[0.3em] text-ink-400">Datum</div>
                        <div class="display mt-2 text-3xl text-ink-50">{{ $ride->departure_time->isoFormat('D MMM') }}</div>
                        <div class="font-mono text-xs text-ink-300">{{ $ride->departure_time->isoFormat('ddd YYYY') }}</div>
                    </div>
                    <div>
                        <div class="font-mono text-[10px] uppercase tracking-[0.3em] text-ink-400">Tijd</div>
                        <div class="display mt-2 text-3xl text-ink-50">{{ $ride->departure_time->format('H:i') }}</div>
                    </div>
                    <div>
                        <div class="font-mono text-[10px] uppercase tracking-[0.3em] text-ink-400">Capaciteit</div>
                        <div class="display mt-2 text-3xl text-ink-50">{{ $ride->total_seats }}</div>
                    </div>
                    <div>
                        <div class="font-mono text-[10px] uppercase tracking-[0.3em] text-ink-400">Bezet</div>
                        <div class="display mt-2 text-3xl text-ink-50">{{ $ride->booked_seats }}</div>
                    </div>
                </div>
                <div class="mt-6 flex flex-wrap items-center gap-3 border-t border-white/0.06 pt-6">
                    <x-seat-badge :ride="$ride" />
                    <span class="rounded-full border border-white/10 bg-white/0.04 px-3 py-1.5 font-mono text-[10px] uppercase tracking-[0.3em] text-ink-300">
                        Vanuit {{ $ride->departure_city }}
                    </span>
                </div>
            </x-card>

            <x-card eyebrow="Beschrijving">
                <p class="whitespace-pre-line text-base leading-relaxed text-ink-200">
                    {{ $ride->description ?: 'Geen verdere details meegegeven.' }}
                </p>
            </x-card>
        </div>

        <aside class="space-y-6">
            <a href="{{ route('festivals.show', $ride->festival) }}" class="block transition-transform duration-300 hover:-translate-y-1">
                <x-festival-poster :festival="$ride->festival" size="md" />
                <div class="mt-3 flex items-center justify-between px-1 font-mono text-[10px] uppercase tracking-[0.3em]">
                    <span class="text-ink-400">Bestemming</span>
                    <span class="text-flame-400">→ Bekijk</span>
                </div>
            </a>

            <x-card eyebrow="Acties">
                <div class="flex flex-col gap-2">
                    <x-button :href="route('rides.edit', $ride)" variant="secondary">Bewerken</x-button>
                    <form method="POST" action="{{ route('rides.destroy', $ride) }}" onsubmit="return confirm('Rit verwijderen?')" class="contents">
                        @csrf
                        @method('DELETE')
                        <x-button variant="danger" type="submit" class="w-full">Verwijderen</x-button>
                    </form>
                </div>
            </x-card>
        </aside>
    </div>
</x-layout>
