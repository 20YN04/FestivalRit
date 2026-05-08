@props(['name', 'label' => null, 'value' => null, 'rows' => 4])

<div class="flex flex-col gap-2">
    @if ($label)
        <label for="{{ $name }}" class="font-mono text-[10px] uppercase tracking-[0.35em] text-ink-300">{{ $label }}</label>
    @endif

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->class([
            'w-full rounded-2xl border border-white/10 bg-ink-900/60 px-4 py-3 text-base text-ink-50 placeholder:text-ink-500 backdrop-blur-md transition focus:border-flame-400/60 focus:outline-none focus:ring-4 focus:ring-flame-400/10',
            '!border-flame-500/60' => $errors->has($name),
        ]) }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="text-xs text-flame-400">{{ $message }}</p>
    @enderror
</div>
