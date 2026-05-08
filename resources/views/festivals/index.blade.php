<x-layout title="Festivals">
    <section class="animate-hero mb-16 max-w-4xl">
        <div class="font-mono text-xs uppercase tracking-[0.4em] text-flame-400">// Line·up 2026</div>
        <h1 class="display mt-4 text-7xl uppercase leading-[0.85] text-ink-50 md:text-9xl">
            Vind je rit<br>
            naar het <span class="text-gradient-flame">festival</span>.
        </h1>
        <p class="mt-8 max-w-xl text-lg leading-relaxed text-ink-300">
            Bekijk alle aankomende festivals, ontdek wie er met de wagen vertrekt
            en stap mee — vanuit jouw stad, voor de prijs van een fles cava.
        </p>
        <div class="mt-8 flex flex-wrap items-center gap-3">
            <x-button :href="route('rides.create')" size="lg">+ Bied een rit aan</x-button>
            <x-button :href="route('rides.index')" variant="secondary" size="lg">Bekijk ritten</x-button>
        </div>
    </section>

    <div class="mb-8 flex items-end justify-between">
        <div>
            <div class="font-mono text-[10px] uppercase tracking-[0.4em] text-flame-400">// Alle festivals</div>
            <h2 class="display mt-2 text-4xl uppercase text-ink-100 md:text-5xl">Wie speelt wanneer</h2>
        </div>
        <x-button :href="route('festivals.create')" variant="secondary" size="sm">+ Festival</x-button>
    </div>

    @if ($festivals->isEmpty())
        <x-card>
            <p class="text-ink-300">Nog geen festivals. Voeg het eerste toe.</p>
        </x-card>
    @else
        <div class="grid gap-5 md:grid-cols-2">
            @foreach ($festivals as $festival)
                <a href="{{ route('festivals.show', $festival) }}" class="group block transition-transform duration-300 hover:-translate-y-1">
                    <x-festival-poster :festival="$festival" size="md" />
                    <div class="mt-4 flex items-center justify-between px-1">
                        <div class="font-mono text-[10px] uppercase tracking-[0.35em] text-ink-400">
                            {{ $festival->rides_count }} {{ Str::plural('rit', $festival->rides_count) }} aangeboden
                        </div>
                        <div class="font-mono text-[10px] uppercase tracking-[0.35em] text-flame-400 transition-transform duration-300 group-hover:translate-x-1">
                            Bekijk →
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $festivals->links() }}
        </div>
    @endif
</x-layout>
