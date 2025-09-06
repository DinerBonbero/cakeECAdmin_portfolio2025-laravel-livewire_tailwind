<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-amber-50 dark:bg-zinc-800 relative">
    <div class="w-auto text-center">
        <img class="w-4/9 py-2 inline" src="{{ asset('images/logo.png') }}" />
        @can('user')
            <a href="route('mycart_items.index')"><img
                    class="size-20 inline absolute right-0 top-0"src="{{ asset('images/icon_cart.png') }}" /></a>
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
                        <li class="py-1"><a href="{{ route('user_info.create') }}" wire:navigate>ユーザー情報の設定</a></li>
                        <li class="py-1"><a href="{{ route('order.history') }}" wire:navigate>購入履歴</a></li>
                    @endcan
                    @can('is_admin')
                        <li class="py-1"><a href="{{ route('sales.history') }}" wire:navigate>販売履歴</a></li>
                        <li class="py-1"><a href="{{ route('items.create') }}" wire:navigate>商品登録</a></li>
                    @endcan
                    <li class="py-1"><a href="{{ route('user_password.edit') }}" wire:navigate>パスワード変更</a></li>
                    <li class="py-1">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="w-full text-left">
                                ログアウト
                            </button>
                        </form>
                    </li>
                </span>
            </details>
        @else
            <a href="{{ route('login') }}" class="inline-block ps-2 pe-5 lg:ms-0" wire:navigate>ログイン</a>
            <a href="{{ route('register') }}" class="inline-block ps-2 pe-5 lg:ms-0" wire:navigate>新規登録</a>
        @endauth
        {{-- ms-2 me-5 --}}

    </flux:header>

    <div class="mx-auto max-w-7xl text-center">
        {{ $slot }}
    </div>
    @fluxScripts
</body>

</html>
