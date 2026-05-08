<x-layout title="Ritten">
    <x-slot:header>
        <h1 class="text-2xl font-semibold tracking-tight">Ritten</h1>
        <x-button :href="route('rides.create')">Nieuwe rit</x-button>
    </x-slot:header>

    @if ($rides->isEmpty())
        <x-card>
            <p class="text-sm text-neutral-600">Nog geen ritten geregistreerd.</p>
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
                                · {{ $ride->available_seats }} {{ Str::plural('plaats', $ride->available_seats) }}
                            </p>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    @endif
</x-layout>
