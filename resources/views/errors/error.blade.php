<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-amber-50 dark:bg-zinc-800 relative">
    <div class="w-auto text-center">
        <img class="w-4/9 py-2 inline" src="{{ asset('images/logo.png') }}" />
    </div>
    <div class="mx-auto max-w-7xl text-center">
        <div class="p-10 my-10 bg-white text-2xl font-serif text-gray-800">
            <p class="mb-3">予期しないエラーです。</p>
            <p>現在、問題が発生しています。</p>
            <p class="mb-3">しばらくしてから再度アクセスしてください</p>
            <p>問題が解決しない場合は、<br>サポートにお問い合わせください</p>
        </div>
        @fluxScripts
    </div>
</body>

</html>