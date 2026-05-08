<x-layout title="Nieuwe rit">
    <a href="{{ route('rides.index') }}" class="mb-8 inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.35em] text-ink-400 transition hover:text-flame-400">
        ← Alle ritten
    </a>

    <div class="animate-hero mb-12 max-w-3xl">
        <div class="font-mono text-xs uppercase tracking-[0.4em] text-flame-400">// Bied een rit aan</div>
        <h1 class="display mt-3 text-6xl uppercase leading-[0.85] text-ink-50 md:text-7xl">
            Wie rijdt er <span class="text-gradient-flame">mee</span>?
        </h1>
        <p class="mt-6 max-w-xl text-base text-ink-300">
            Vul in vanwaar je vertrekt en hoeveel plaatsen je hebt. Je kan altijd later bewerken.
        </p>
    </div>

    <div class="mx-auto max-w-3xl">
        <x-card eyebrow="Rit details">
            <x-ride-form
                :festivals="$festivals"
                :action="route('rides.store')"
                :selected-festival-id="$selectedFestivalId"
            />
        </x-card>
    </div>
</x-layout>
