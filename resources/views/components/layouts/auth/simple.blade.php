<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="bg-amber-50 min-h-screen antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="w-auto text-center pb-5 md:pb-10">
        <div class="pb-3">
            <img class="w-4/9 py-2 inline" src="{{ asset('storage/images/logo.png') }}" />
        </div>
        <div>
            <span class="serif">patisserie Notてんぐ!</span>
            <img class="size-20 py-2 inline" src="{{ asset('storage/images/purin.png') }}" />
        </div>
    </div>
    <div class="bg-background flex min-h-[70svh] flex-col items-center gap-6 pr-6 pl-6 md:pr-10 md:pl-10">
        <div class="flex w-full max-w-sm flex-col gap-2">
            <div class="flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>
