<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-amber-50 dark:bg-zinc-800 relative">
    <div class="w-auto text-center">
        <img class="w-4/9 py-2 inline" src="{{ asset('images/logo.png') }}" />
        @can('user')
            <a href=""><img class="size-20 inline absolute right-0 top-0"src="{{ asset('images/icon_cart.png') }}" /></a>
        @endcan
    </div>

    <flux:header container class="border-b border-zinc-200">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ route('items.index') }}" class="inline-block ps-2 pe-5 lg:ms-0" wire:navigate>
            HOME
        </a>

        <flux:spacer />

        @auth
            <details>
                <summary class="px-7 text-center lg:ms-0 text-lg list-none"><span>{{ Auth::user()->name }}</span></summary>
                <span class="list-none text-left">
                    @can('user')
                        <li class="py-1"><a href="{{route('user_info.create')}}" wire:navigate>ユーザー情報の設定</a></li>
                        <li class="py-1"><a href="{{route('order.history')}}" wire:navigate>購入履歴</a></li>
                    @endcan
                    @can('is_admin')
                        <li class="py-1"><a href="{{route('sales.history')}}" wire:navigate>販売履歴</a></li>
                        <li class="py-1"><a href="{{route('items.create')}}" wire:navigate>商品登録</a></li>
                    @endcan
                    <li class="py-1"><a href="{{route('user_password.edit')}}" wire:navigate>パスワード変更</a></li>
                    <li class="py-1"><a href="{{route('logout')}}" wire:navigate>ログアウト</a></li>
                </span>
            </details>
        @else
            <a href="{{ route('login') }}" class="inline-block ps-2 pe-5 lg:ms-0" wire:navigate>ログイン</a>
            <a href="{{ route('register') }}" class="inline-block ps-2 pe-5 lg:ms-0" wire:navigate>新規登録</a>
        @endauth
        {{-- ms-2 me-5 --}}

    </flux:header>

    <!-- Mobile Menu -->
    {{-- <flux:sidebar stashable sticky
        class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')">
                <flux:navlist.item icon="layout-grid" :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                target="_blank">
                {{ __('Repository') }}
            </flux:navlist.item>

            <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank">
                {{ __('Documentation') }}
            </flux:navlist.item>
        </flux:navlist>
    </flux:sidebar> --}}

    <div class="mx-auto max-w-7xl text-center">
        {{ $slot }}
    </div>
    @fluxScripts
</body>

</html>
