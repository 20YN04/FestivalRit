<x-layout :title="$festival->name">
    <a href="{{ route('festivals.index') }}" class="mb-8 inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.35em] text-ink-400 transition hover:text-flame-400">
        ← Alle festivals
    </a>

    <div class="animate-hero mb-12">
        <x-festival-poster :festival="$festival" size="xl" />
    </div>

    <div class="mb-12 flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-2">
            <span class="rounded-full border border-white/10 bg-white/[0.04] px-3 py-1.5 font-mono text-[10px] uppercase tracking-[0.3em] text-ink-300">
                {{ $festival->location }}
            </span>
            <span class="rounded-full border border-acid-400/30 bg-acid-400/[0.06] px-3 py-1.5 font-mono text-[10px] uppercase tracking-[0.3em] text-acid-300">
                {{ $festival->rides->count() }} {{ Str::plural('rit', $festival->rides->count()) }}
            </span>
        </div>
        <div class="flex items-center gap-2">
            <x-button variant="secondary" size="sm" :href="route('festivals.edit', $festival)">Bewerken</x-button>
            <form method="POST" action="{{ route('festivals.destroy', $festival) }}" onsubmit="return confirm('Festival verwijderen?')">
                @csrf
                @method('DELETE')
                <x-button variant="danger" size="sm" type="submit">Verwijderen</x-button>
            </form>
        </div>
    </div>

    <div class="mb-8 flex items-end justify-between">
        <div>
            <div class="font-mono text-[10px] uppercase tracking-[0.4em] text-flame-400">// Line up · ritten</div>
            <h2 class="display mt-2 text-4xl uppercase text-ink-50 md:text-5xl">Wie rijdt mee</h2>
        </div>
        <x-button :href="route('rides.create', ['festival_id' => $festival->id])">+ Rit aanbieden</x-button>
    </div>

    @if ($festival->rides->isEmpty())
        <x-card>
            <p class="text-ink-300">Nog geen ritten voor dit festival. Wees de eerste die meerijdt.</p>
        </x-card>
    @else
        <div class="grid gap-4 md:grid-cols-2">
            @foreach ($festival->rides as $ride)
                <x-ride-ticket :ride="$ride" />
            @endforeach
        </div>
    @endif
</x-layout>
