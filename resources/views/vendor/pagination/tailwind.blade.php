@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginatie" class="flex items-center justify-center gap-2 font-mono text-[11px] uppercase tracking-[0.25em]">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" class="rounded-full border border-white/4 bg-white/2 px-4 py-2 text-ink-600">
                ← Vorige
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="rounded-full border border-white/10 bg-white/4 px-4 py-2 text-ink-200 transition hover:border-flame-400/40 hover:bg-flame-500/10 hover:text-flame-200">
                ← Vorige
            </a>
        @endif

        {{-- Numbers --}}
        <div class="hidden items-center gap-1 md:flex">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-ink-500">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="rounded-full bg-linear-to-r from-flame-500 to-magenta-500 px-3.5 py-1.5 text-ink-950 shadow-[0_0_24px_-6px] shadow-flame-500/60">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="rounded-full px-3.5 py-1.5 text-ink-300 transition hover:bg-white/5 hover:text-ink-50">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Mobile counter --}}
        <span class="rounded-full border border-white/10 bg-white/4 px-3 py-1.5 text-ink-300 md:hidden">
            {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
        </span>

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="rounded-full border border-white/10 bg-white/4 px-4 py-2 text-ink-200 transition hover:border-flame-400/40 hover:bg-flame-500/10 hover:text-flame-200">
                Volgende →
            </a>
        @else
            <span aria-disabled="true" class="rounded-full border border-white/4 bg-white/2 px-4 py-2 text-ink-600">
                Volgende →
            </span>
        @endif
    </nav>
@endif
