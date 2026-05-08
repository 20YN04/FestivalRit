<x-layout :title="'Rit van ' . $ride->driver_name">
    <x-slot:header>
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">{{ $ride->driver_name }}</h1>
            <p class="text-sm text-neutral-600">
                Naar
                <a href="{{ route('festivals.show', $ride->festival) }}" class="font-medium hover:underline">
                    {{ $ride->festival->name }}
                </a>
            </p>
        </div>
        <div class="flex items-center gap-2">
            <x-button variant="secondary" :href="route('rides.edit', $ride)">Bewerken</x-button>
            <form method="POST" action="{{ route('rides.destroy', $ride) }}" onsubmit="return confirm('Rit verwijderen?')">
                @csrf
                @method('DELETE')
                <x-button variant="danger" type="submit">Verwijderen</x-button>
            </form>
        </div>
    </x-slot:header>

    <div class="grid gap-4 md:grid-cols-2">
        <x-card title="Vertrek">
            <dl class="space-y-1 text-sm">
                <div class="flex justify-between"><dt class="text-neutral-500">Vanuit</dt><dd>{{ $ride->departure_city }}</dd></div>
                <div class="flex justify-between"><dt class="text-neutral-500">Tijd</dt><dd>{{ $ride->departure_time->format('d M Y, H:i') }}</dd></div>
                <div class="flex justify-between"><dt class="text-neutral-500">Plaatsen</dt><dd>{{ $ride->available_seats }}</dd></div>
            </dl>
        </x-card>

        <x-card title="Beschrijving">
            <p class="text-sm text-neutral-700 whitespace-pre-line">
                {{ $ride->description ?: 'Geen beschrijving.' }}
            </p>
        </x-card>
    </div>
</x-layout>
