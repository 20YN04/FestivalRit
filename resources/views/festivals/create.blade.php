<x-layout title="Nieuw festival">
    <x-slot:header>
        <h1 class="text-2xl font-semibold tracking-tight">Nieuw festival</h1>
        <x-button variant="secondary" :href="route('festivals.index')">Annuleren</x-button>
    </x-slot:header>

    <x-card>
        <form method="POST" action="{{ route('festivals.store') }}" class="flex flex-col gap-4">
            @csrf
            <x-input name="name" label="Naam" required />
            <x-input name="location" label="Locatie" required />

            <div class="flex justify-end">
                <x-button type="submit">Aanmaken</x-button>
            </div>
        </form>
    </x-card>
</x-layout>
