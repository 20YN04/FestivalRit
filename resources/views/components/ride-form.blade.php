@props(['ride' => null, 'festivals', 'action', 'method' => 'POST', 'selectedFestivalId' => null])

@php
    $currentFestival = old('festival_id', $ride?->festival_id ?? $selectedFestivalId);
    $departureValue = old('departure_time', $ride?->departure_time?->format('Y-m-d\TH:i'));
@endphp

<form method="POST" action="{{ $action }}" class="flex flex-col gap-4">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="flex flex-col gap-1">
        <label for="festival_id" class="text-sm font-medium text-neutral-700">
            Festival <span class="text-red-600">*</span>
        </label>
        <select id="festival_id" name="festival_id" required
            @class([
                'rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-neutral-900 focus:outline-none focus:ring-1 focus:ring-neutral-900',
                'border-red-500' => $errors->has('festival_id'),
            ])>
            <option value="">— Kies een festival —</option>
            @foreach ($festivals as $festival)
                <option value="{{ $festival->id }}" @selected((int) $currentFestival === $festival->id)>
                    {{ $festival->name }}
                </option>
            @endforeach
        </select>
        @error('festival_id')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
    </div>

    <x-input name="driver_name" label="Naam chauffeur" :value="$ride?->driver_name" required />
    <x-input name="departure_city" label="Vertrek vanuit" :value="$ride?->departure_city" required />

    <div class="grid gap-4 md:grid-cols-2">
        <x-input name="available_seats" type="number" min="1" max="50" label="Beschikbare plaatsen" :value="$ride?->available_seats" required />
        <x-input name="departure_time" type="datetime-local" label="Vertrektijd" :value="$departureValue" required />
    </div>

    <x-textarea name="description" label="Beschrijving" :value="$ride?->description" />

    <div class="flex justify-end">
        <x-button type="submit">Opslaan</x-button>
    </div>
</form>
