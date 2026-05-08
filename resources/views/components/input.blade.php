@props(['name', 'label' => null, 'type' => 'text', 'value' => null, 'required' => false])

<div class="flex flex-col gap-1">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-neutral-700">
            {{ $label }}@if ($required) <span class="text-red-600">*</span>@endif
        </label>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        @if ($required) required @endif
        {{ $attributes->class([
            'rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-neutral-900 focus:outline-none focus:ring-1 focus:ring-neutral-900',
            'border-red-500' => $errors->has($name),
        ]) }}
    >

    @error($name)
        <p class="text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
