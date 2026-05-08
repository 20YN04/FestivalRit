@props(['name', 'label' => null, 'value' => null, 'rows' => 4])

<div class="flex flex-col gap-1">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-neutral-700">{{ $label }}</label>
    @endif

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->class([
            'rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-neutral-900 focus:outline-none focus:ring-1 focus:ring-neutral-900',
            'border-red-500' => $errors->has($name),
        ]) }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
