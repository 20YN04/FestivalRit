@props(['title' => null, 'eyebrow' => null])

<div {{ $attributes->class([
    'relative overflow-hidden rounded-3xl border border-white/[0.07] bg-linear-to-b from-white/[0.04] to-white/[0.01] p-6 shadow-[0_24px_60px_-30px_rgba(0,0,0,0.9)] backdrop-blur-md',
]) }}>
    @if ($eyebrow)
        <div class="mb-3 font-mono text-[10px] uppercase tracking-[0.35em] text-flame-400">// {{ $eyebrow }}</div>
    @endif
    @if ($title)
        <h3 class="mb-4 text-xl font-semibold tracking-tight text-ink-50">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>
