@props(['title' => null])

<div {{ $attributes->class(['rounded-xl border border-neutral-200 bg-white p-5 shadow-sm']) }}>
    @if ($title)
        <h3 class="mb-2 text-base font-semibold text-neutral-900">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>
