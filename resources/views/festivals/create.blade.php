<x-layout title="Nieuw festival">
    <a href="{{ route('festivals.index') }}" class="mb-8 inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.35em] text-ink-400 transition hover:text-flame-400">
        ← Alle festivals
    </a>

    <div class="animate-hero mb-12 max-w-3xl">
        <div class="font-mono text-xs uppercase tracking-[0.4em] text-flame-400">// Nieuw festival</div>
        <h1 class="display mt-3 text-6xl uppercase leading-[0.85] text-ink-50 md:text-7xl">
            Voeg een <span class="text-gradient-flame">festival</span> toe.
        </h1>
        <p class="mt-6 max-w-xl text-base text-ink-300">
            Naam en locatie volstaan — ritten worden er los aan gekoppeld.
        </p>
    </div>

    <div class="mx-auto max-w-2xl">
        <x-card eyebrow="Festival info">
            <form method="POST" action="{{ route('festivals.store') }}" class="flex flex-col gap-5">
                @csrf
                <x-input name="name" label="Naam" required />
                <x-input name="location" label="Locatie" required />

                <div class="flex items-center justify-between pt-2">
                    <x-button variant="ghost" :href="route('festivals.index')">Annuleren</x-button>
                    <x-button type="submit" size="lg">Aanmaken</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>
