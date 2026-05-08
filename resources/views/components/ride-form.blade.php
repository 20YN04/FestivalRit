@props(['ride' => null, 'festivals', 'action', 'method' => 'POST', 'selectedFestivalId' => null])

@php
    $currentFestival = old('festival_id', $ride?->festival_id ?? $selectedFestivalId);
    $departureValue = old('departure_time', $ride?->departure_time?->format('Y-m-d\TH:i'));
@endphp

<form method="POST" action="{{ $action }}" class="flex flex-col gap-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="flex flex-col gap-2">
        <label for="festival_id" class="font-mono text-[10px] uppercase tracking-[0.35em] text-ink-300">
            Festival <span class="text-flame-400">*</span>
        </label>
        <select id="festival_id" name="festival_id" required
            @class([
                'w-full appearance-none rounded-2xl border border-white/10 bg-ink-900/60 px-4 py-3 text-base text-ink-50 backdrop-blur-md transition focus:border-flame-400/60 focus:outline-none focus:ring-4 focus:ring-flame-400/10',
                '!border-flame-500/60' => $errors->has('festival_id'),
            ])>
            <option value="">— Kies een festival —</option>
            @foreach ($festivals as $festival)
                <option value="{{ $festival->id }}" @selected((int) $currentFestival === $festival->id)>
                    {{ $festival->name }}
                </option>
            @endforeach
        </select>
        @error('festival_id')<p class="text-xs text-flame-400">{{ $message }}</p>@enderror
    </div>

    <div class="grid gap-5 md:grid-cols-2">
        <x-input name="driver_name" label="Naam chauffeur" :value="$ride?->driver_name" required />
        <x-input name="departure_city" label="Vertrek vanuit" :value="$ride?->departure_city" required />
    </div>

    <div class="grid gap-5 md:grid-cols-3">
        <x-input name="total_seats" type="number" min="1" max="50" label="Aantal plaatsen" :value="$ride?->total_seats" required />
        <x-input name="booked_seats" type="number" min="0" max="50" label="Reeds bezet" :value="$ride?->booked_seats ?? 0" />
        <x-input name="departure_time" type="datetime-local" label="Vertrektijd" :value="$departureValue" required />
    </div>

    <x-textarea name="description" label="Beschrijving" :value="$ride?->description" rows="5" />

    <div class="flex justify-end pt-2">
        <x-button type="submit" size="lg">Opslaan</x-button>
    </div>
</form>
