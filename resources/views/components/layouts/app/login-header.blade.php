<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-amber-50 dark:bg-zinc-800">
    <div class="flex items-center justify-center">
        <img class="w-4/9 py-2" src="{{ asset('images/logo.png') }}" />
    </div>

    <flux:header container class="border-b border-zinc-200">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ route('items.index') }}" class="inline-block ps-2 pe-5 flex items-center lg:ms-0" wire:navigate>
            HOME
        </a>

        <flux:spacer />

        

    </flux:header>

    <div class="mx-auto max-w-7xl text-center">
        {{ $slot }}
    </div>
    @fluxScripts
</body>

</html>