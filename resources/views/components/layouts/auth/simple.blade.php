<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body
    class="bg-amber-50 min-h-screen antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="w-auto text-center pb-5 md:pb-10">
        <div class="pb-3"><img class="w-4/9 py-2 inline" src="{{ asset('storage/images/logo.png') }}" /></div>
        <div class="serif">patisserie  ポートフォリオ</div>
    </div>
    <div
        class="bg-background flex min-h-[70svh] flex-col items-center gap-6 pr-6 pl-6 md:pr-10 md:pl-10">
        <div class="flex w-full max-w-sm flex-col gap-2">
            {{-- <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-9 w-9 mb-1 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a> --}}

            <div class="flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>
