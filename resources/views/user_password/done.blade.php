<x-layouts.app.header>
    <div class="w-7/8 min-[690px]:w-5/8 mx-auto">
        <div class="p-10 mt-15 mb-17 bg-white font-serif text-gray-800 border-1 border-solid border-gray-200">
            <p class="text-[13px] min-[360px]:text-base md:text-2xl">パスワードを変更しました。</p>
        </div>
        <x-button.brown-link message="ホームに戻る" href="{{ route('items.index') }}" />
    </div>
</x-layouts.app.header>