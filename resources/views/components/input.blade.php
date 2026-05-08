@props(['name', 'label' => null, 'type' => 'text', 'value' => null, 'required' => false, 'hint' => null])

<div class="flex flex-col gap-2">
    @if ($label)
        <label for="{{ $name }}" class="font-mono text-[10px] uppercase tracking-[0.35em] text-ink-300">
            {{ $label }}@if ($required) <span class="text-flame-400">*</span>@endif
        </label>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        @if ($required) required @endif
        {{ $attributes->class([
            'w-full rounded-2xl border border-white/10 bg-ink-900/60 px-4 py-3 text-base text-ink-50 placeholder:text-ink-500 backdrop-blur-md transition focus:border-flame-400/60 focus:outline-none focus:ring-4 focus:ring-flame-400/10',
            '!border-flame-500/60' => $errors->has($name),
        ]) }}
    >

    @if ($hint && !$errors->has($name))
        <p class="text-xs text-ink-400">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="text-xs text-flame-400">{{ $message }}</p>
    @enderror
</div>
