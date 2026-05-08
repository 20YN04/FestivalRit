<x-layout title="Festivals">
    <x-slot:header>
        <h1 class="text-2xl font-semibold tracking-tight">Festivals</h1>
        <x-button :href="route('festivals.create')">Nieuw festival</x-button>
    </x-slot:header>

    @if ($festivals->isEmpty())
        <x-card>
            <p class="text-sm text-neutral-600">Nog geen festivals. Maak het eerste aan.</p>
        </x-card>
    @else
        <div class="grid gap-4 md:grid-cols-2">
            @foreach ($festivals as $festival)
                <x-card>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <a href="{{ route('festivals.show', $festival) }}" class="text-lg font-semibold hover:underline">
                                {{ $festival->name }}
                            </a>
                            <p class="text-sm text-neutral-600">{{ $festival->location }}</p>
                        </div>
                        <span class="rounded-full bg-neutral-100 px-2.5 py-1 text-xs font-medium text-neutral-700">
                            {{ $festival->rides_count }} {{ Str::plural('rit', $festival->rides_count) }}
                        </span>
                    </div>
                </x-card>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $festivals->links() }}
        </div>
    @endif
</x-layout>
