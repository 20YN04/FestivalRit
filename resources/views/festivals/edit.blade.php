<x-layout title="Festival bewerken">
    <a href="{{ route('festivals.show', $festival) }}" class="mb-8 inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.35em] text-ink-400 transition hover:text-flame-400">
        ← Terug naar {{ $festival->name }}
    </a>

    <div class="animate-hero mb-12 max-w-3xl">
        <div class="font-mono text-xs uppercase tracking-[0.4em] text-flame-400">// Bewerken</div>
        <h1 class="display mt-3 text-6xl uppercase leading-[0.85] text-ink-50 md:text-7xl">
            {{ $festival->name }}
        </h1>
    </div>

    <div class="mx-auto max-w-2xl">
        <x-card eyebrow="Festival info">
            <form method="POST" action="{{ route('festivals.update', $festival) }}" class="flex flex-col gap-5">
                @csrf
                @method('PUT')
                <x-input name="name" label="Naam" :value="$festival->name" required />
                <x-input name="location" label="Locatie" :value="$festival->location" required />

                <div class="flex items-center justify-between pt-2">
                    <x-button variant="ghost" :href="route('festivals.show', $festival)">Annuleren</x-button>
                    <x-button type="submit" size="lg">Opslaan</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>
