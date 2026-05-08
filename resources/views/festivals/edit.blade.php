<x-layout title="Festival bewerken">
    <x-slot:header>
        <h1 class="text-2xl font-semibold tracking-tight">Festival bewerken</h1>
        <x-button variant="secondary" :href="route('festivals.show', $festival)">Annuleren</x-button>
    </x-slot:header>

    <x-card>
        <form method="POST" action="{{ route('festivals.update', $festival) }}" class="flex flex-col gap-4">
            @csrf
            @method('PUT')
            <x-input name="name" label="Naam" :value="$festival->name" required />
            <x-input name="location" label="Locatie" :value="$festival->location" required />

            <div class="flex justify-end">
                <x-button type="submit">Opslaan</x-button>
            </div>
        </form>
    </x-card>
</x-layout>
