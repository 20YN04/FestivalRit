<x-layout title="Registreren">
    <div class="mx-auto flex min-h-[70vh] max-w-xl flex-col justify-center">
        <div class="animate-hero mb-10">
            <div class="font-mono text-xs uppercase tracking-[0.4em] text-flame-400">// Eerste keer</div>
            <h1 class="display mt-3 text-6xl uppercase leading-[0.85] text-ink-50 md:text-7xl">
                Maak je <span class="text-gradient-flame">pass</span> aan.
            </h1>
            <p class="mt-6 max-w-md text-base text-ink-300">
                Eén account voor alle festivals. Bied ritten aan, stap mee, deel de
                kosten — en verzamel kilometers met je crew.
            </p>
        </div>

        <x-card eyebrow="Account aanmaken">
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
                @csrf

                <x-input name="name" label="Naam" required autocomplete="name" autofocus />
                <x-input name="email" type="email" label="E-mail" required autocomplete="email" />
                <x-input name="password" type="password" label="Wachtwoord" required autocomplete="new-password" hint="Minimum 8 tekens." />
                <x-input name="password_confirmation" type="password" label="Bevestig wachtwoord" required autocomplete="new-password" />

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('login') }}" class="font-mono text-[10px] uppercase tracking-[0.3em] text-ink-400 transition hover:text-flame-400">
                        Al een account? →
                    </a>
                    <x-button type="submit" size="lg">Aanmaken</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>
