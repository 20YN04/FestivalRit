<x-layout title="Nieuwe rit">
    <x-slot:header>
        <h1 class="text-2xl font-semibold tracking-tight">Nieuwe rit</h1>
        <x-button variant="secondary" :href="route('rides.index')">Annuleren</x-button>
    </x-slot:header>

    <x-card>
        <x-ride-form
            :festivals="$festivals"
            :action="route('rides.store')"
            :selected-festival-id="$selectedFestivalId"
        />
    </x-card>
</x-layout>
