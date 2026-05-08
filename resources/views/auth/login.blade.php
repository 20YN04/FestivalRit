<x-layout title="Inloggen">
    <div class="mx-auto flex min-h-[70vh] max-w-xl flex-col justify-center">
        <div class="animate-hero mb-10">
            <div class="font-mono text-xs uppercase tracking-[0.4em] text-flame-400">// Welkom terug</div>
            <h1 class="display mt-3 text-6xl uppercase leading-[0.85] text-ink-50 md:text-7xl">
                Stap weer <span class="text-gradient-flame">in</span>.
            </h1>
            <p class="mt-6 max-w-md text-base text-ink-300">
                Log in om je ritten te beheren en mee te rijden naar het volgende festival.
            </p>
        </div>

        <x-card eyebrow="Inloggen">
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                @csrf

                <x-input name="email" type="email" label="E-mail" required autocomplete="email" autofocus />
                <x-input name="password" type="password" label="Wachtwoord" required autocomplete="current-password" />

                <label class="flex items-center gap-2 text-sm text-ink-300">
                    <input type="checkbox" name="remember" value="1"
                        class="h-4 w-4 rounded border-white/20 bg-ink-900 text-flame-500 focus:ring-flame-400/40">
                    Onthoud me op dit toestel
                </label>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('register') }}" class="font-mono text-[10px] uppercase tracking-[0.3em] text-ink-400 transition hover:text-flame-400">
                        Nog geen account? →
                    </a>
                    <x-button type="submit" size="lg">Inloggen</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>
