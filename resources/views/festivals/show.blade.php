<x-layout :title="$festival->name">
    <x-slot:header>
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">{{ $festival->name }}</h1>
            <p class="text-sm text-neutral-600">{{ $festival->location }}</p>
        </div>
        <div class="flex items-center gap-2">
            <x-button variant="secondary" :href="route('festivals.edit', $festival)">Bewerken</x-button>
            <form method="POST" action="{{ route('festivals.destroy', $festival) }}" onsubmit="return confirm('Festival verwijderen?')">
                @csrf
                @method('DELETE')
                <x-button variant="danger" type="submit">Verwijderen</x-button>
            </form>
        </div>
    </x-slot:header>

    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-lg font-semibold">Ritten</h2>
        <x-button :href="route('rides.create', ['festival_id' => $festival->id])">Rit toevoegen</x-button>
    </div>

    @if ($festival->rides->isEmpty())
        <x-card>
            <p class="text-sm text-neutral-600">Nog geen ritten voor dit festival.</p>
        </x-card>
    @else
        <div class="grid gap-3">
            @foreach ($festival->rides as $ride)
                <x-card>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <a href="{{ route('rides.show', $ride) }}" class="font-semibold hover:underline">
                                {{ $ride->driver_name }} — vanuit {{ $ride->departure_city }}
                            </a>
                            <p class="text-sm text-neutral-600">
                                {{ $ride->departure_time->format('d M Y, H:i') }}
                            </p>
                        </div>
                        <x-seat-badge :ride="$ride" />
                    </div>
                </x-card>
            @endforeach
        </div>
    @endif
</x-layout>
