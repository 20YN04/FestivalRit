<x-layout title="Rit bewerken">
    <a href="{{ route('rides.show', $ride) }}" class="mb-8 inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.35em] text-ink-400 transition hover:text-flame-400">
        ← Terug naar rit
    </a>

    <div class="animate-hero mb-12 max-w-3xl">
        <div class="font-mono text-xs uppercase tracking-[0.4em] text-flame-400">// Bewerken</div>
        <h1 class="display mt-3 text-6xl uppercase leading-[0.85] text-ink-50 md:text-7xl">
            Rit van {{ $ride->driver_name }}
        </h1>
    </div>

    <div class="mx-auto max-w-3xl">
        <x-card eyebrow="Rit details">
            <x-ride-form
                :ride="$ride"
                :festivals="$festivals"
                :action="route('rides.update', $ride)"
                method="PUT"
            />
        </x-card>
    </div>
</x-layout>
