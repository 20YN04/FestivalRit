<x-layout title="Ritten">
    <section class="animate-hero mb-12 max-w-4xl">
        <div class="font-mono text-xs uppercase tracking-[0.4em] text-flame-400">// On the road</div>
        <h1 class="display mt-4 text-7xl uppercase leading-[0.85] text-ink-50 md:text-9xl">
            Ritten op<br>
            weg naar het <span class="text-gradient-flame">festival</span>.
        </h1>
        <p class="mt-8 max-w-xl text-lg leading-relaxed text-ink-300">
            Stap mee, deel de kosten, kom samen aan. Filter op festival om alleen
            relevante ritten te tonen.
        </p>
    </section>

    <form method="GET" action="{{ route('rides.index') }}" class="mb-10 flex flex-wrap items-center gap-2 rounded-full border border-white/10 bg-ink-900/40 p-1.5 backdrop-blur-md">
        <span class="hidden px-4 font-mono text-[10px] uppercase tracking-[0.35em] text-ink-400 md:inline-block">// Filter</span>
        <select id="festival_id" name="festival_id"
            class="flex-1 min-w-0 appearance-none rounded-full border-0 bg-transparent px-4 py-2.5 text-sm text-ink-100 focus:outline-none">
            <option value="">Alle festivals</option>
            @foreach ($festivals as $festival)
                <option value="{{ $festival->id }}" @selected($selectedFestivalId === $festival->id)>
                    {{ $festival->name }}
                </option>
            @endforeach
        </select>
        <x-button type="submit" size="sm">Toon</x-button>
        @if ($selectedFestivalId)
            <x-button variant="ghost" size="sm" :href="route('rides.index')">Wis</x-button>
        @endif
    </form>

    @if ($rides->isEmpty())
        <x-card>
            <p class="text-ink-300">
                @if ($selectedFestivalId)
                    Geen ritten voor dit festival. Bied er zelf één aan.
                @else
                    Nog geen ritten geregistreerd.
                @endif
            </p>
        </x-card>
    @else
        <div class="grid gap-5 md:grid-cols-2">
            @foreach ($rides as $ride)
                <x-ride-ticket :ride="$ride" />
            @endforeach
        </div>

        <div class="mt-12">
            {{ $rides->links() }}
        </div>
    @endif
</x-layout>
