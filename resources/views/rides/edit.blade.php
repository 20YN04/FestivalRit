<x-layout title="Rit bewerken">
    <x-slot:header>
        <h1 class="text-2xl font-semibold tracking-tight">Rit bewerken</h1>
        <x-button variant="secondary" :href="route('rides.show', $ride)">Annuleren</x-button>
    </x-slot:header>

    <x-card>
        <x-ride-form
            :ride="$ride"
            :festivals="$festivals"
            :action="route('rides.update', $ride)"
            method="PUT"
        />
    </x-card>
</x-layout>
