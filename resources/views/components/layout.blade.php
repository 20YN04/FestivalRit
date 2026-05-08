@props(['title' => null])

<!DOCTYPE html>
<html lang="nl" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title . ' — FestivalRit' : 'FestivalRit' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-neutral-50 text-neutral-900 antialiased font-sans">
    <header class="border-b border-neutral-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
            <a href="{{ route('festivals.index') }}" class="text-lg font-semibold tracking-tight">
                FestivalRit
            </a>
            <nav class="flex items-center gap-2">
                <x-nav-link :href="route('festivals.index')" :active="request()->routeIs('festivals.*')">
                    Festivals
                </x-nav-link>
                <x-nav-link :href="route('rides.index')" :active="request()->routeIs('rides.*')">
                    Ritten
                </x-nav-link>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-6 py-8">
        @if (session('status'))
            <div class="mb-4 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        @isset($header)
            <div class="mb-6 flex items-center justify-between">
                {{ $header }}
            </div>
        @endisset

        {{ $slot }}
    </main>
</body>
</html>
