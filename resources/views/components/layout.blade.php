@props(['title' => null])

<!DOCTYPE html>
<html lang="nl" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title . ' · FestivalRit' : 'FestivalRit — Vind je rit naar het festival' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full font-sans antialiased text-ink-100 selection:bg-flame-500 selection:text-ink-950">
    <div class="relative z-10">
        <header class="sticky top-0 z-50 border-b border-white/6 bg-ink-950/60 backdrop-blur-xl">
            <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-6 py-4">
                <a href="{{ route('festivals.index') }}" class="group flex items-center gap-3">
                    <span class="relative flex h-9 w-9 items-center justify-center rounded-full bg-linear-to-br from-flame-300 via-flame-500 to-magenta-500 shadow-[0_0_28px_-4px] shadow-flame-500/70 transition-transform duration-300 group-hover:rotate-12">
                        <span class="block h-1.5 w-1.5 rounded-full bg-ink-950"></span>
                    </span>
                    <span class="display text-2xl uppercase tracking-tight text-ink-50">
                        Festival<span class="text-gradient-flame">Rit</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 md:flex">
                    <x-nav-link :href="route('festivals.index')" :active="request()->routeIs('festivals.*')">Festivals</x-nav-link>
                    <x-nav-link :href="route('rides.index')" :active="request()->routeIs('rides.*')">Ritten</x-nav-link>
                </nav>

                <div class="flex items-center gap-2">
                    @auth
                        <span class="hidden items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5 font-mono text-[10px] uppercase tracking-[0.3em] text-ink-300 md:inline-flex">
                            <span class="block h-1.5 w-1.5 rounded-full bg-acid-400 shadow-[0_0_8px] shadow-acid-400"></span>
                            {{ auth()->user()->name }}
                        </span>
                        <x-button :href="route('rides.create')" size="sm">+ Rit aanbieden</x-button>
                        <form method="POST" action="{{ route('logout') }}" class="contents">
                            @csrf
                            <x-button variant="ghost" size="sm" type="submit">Uitloggen</x-button>
                        </form>
                    @else
                        <x-button :href="route('login')" variant="ghost" size="sm">Inloggen</x-button>
                        <x-button :href="route('register')" size="sm">Maak account</x-button>
                    @endauth
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-6 py-12">
            @if (session('status'))
                <div class="animate-hero mb-8 flex items-center gap-3 rounded-2xl border border-acid-400/30 bg-acid-400/6 px-5 py-3 text-sm text-acid-300">
                    <span class="block h-2 w-2 rounded-full bg-acid-400 shadow-[0_0_12px] shadow-acid-400"></span>
                    {{ session('status') }}
                </div>
            @endif

            @isset($header)
                <div class="mb-10 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                    {{ $header }}
                </div>
            @endisset

            {{ $slot }}
        </main>

        <footer class="mt-32 border-t border-white/6 bg-ink-950/60 backdrop-blur-md">
            <div class="mx-auto flex max-w-6xl flex-col gap-6 px-6 py-12 md:flex-row md:items-end md:justify-between">
                <div>
                    <div class="font-mono text-[10px] uppercase tracking-[0.4em] text-flame-400">// Manifesto</div>
                    <div class="display mt-3 max-w-xl text-3xl uppercase leading-tight text-ink-100 md:text-4xl">
                        Veilig samen­rijden naar het volgende festival.
                    </div>
                </div>
                <div class="flex items-center gap-4 font-mono text-[10px] uppercase tracking-[0.3em] text-ink-500">
                    <span>est. 2026</span>
                    <span class="block h-1 w-1 rounded-full bg-flame-500"></span>
                    <span>Made in Belgium</span>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
