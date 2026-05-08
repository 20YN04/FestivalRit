<x-layout title="Ritten">
    <x-slot:header>
        <h1 class="text-2xl font-semibold tracking-tight">Ritten</h1>
        <x-button :href="route('rides.create')">Nieuwe rit</x-button>
    </x-slot:header>

    <x-card>
        <form method="GET" action="{{ route('rides.index') }}" class="flex flex-wrap items-end gap-3">
            <div class="flex flex-col gap-1">
                <label for="festival_id" class="text-sm font-medium text-neutral-700">Filter op festival</label>
                <select id="festival_id" name="festival_id"
                    class="rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-neutral-900 focus:outline-none focus:ring-1 focus:ring-neutral-900">
                    <option value="">— Alle festivals —</option>
                    @foreach ($festivals as $festival)
                        <option value="{{ $festival->id }}" @selected($selectedFestivalId === $festival->id)>
                            {{ $festival->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-button type="submit">Filter</x-button>

            @if ($selectedFestivalId)
                <x-button variant="secondary" :href="route('rides.index')">Wis filter</x-button>
            @endif
        </form>
    </x-card>

    <div class="mt-4">
        @if ($rides->isEmpty())
            <x-card>
                <p class="text-sm text-neutral-600">
                    @if ($selectedFestivalId)
                        Geen ritten voor dit festival.
                    @else
                        Nog geen ritten geregistreerd.
                    @endif
                </p>
            </x-card>
        @else
            <div class="grid gap-3">
                @foreach ($rides as $ride)
                    <x-card>
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <a href="{{ route('rides.show', $ride) }}" class="font-semibold hover:underline">
                                    {{ $ride->driver_name }} → {{ $ride->festival->name }}
                                </a>
                                <p class="text-sm text-neutral-600">
                                    Vanuit {{ $ride->departure_city }}
                                    · {{ $ride->departure_time->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <x-seat-badge :ride="$ride" />
                        </div>
                    </x-card>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $rides->links() }}
            </div>
        @endif
    </div>
</x-layout>
