<x-layouts.app.header>
    <div class="pt-5">
        <span class="text-emerald-500 text-2xl">管理者</span>
    </div>
    <div class="pt-2">
        <span class="text-xl">商品登録画面</span>
    </div>
    <div class="py-3">
        <span class="text-emerald-500">※登録された商品の画像は1:2の縦横比で出力しますのでそれを考慮したうえでアップロードしてください</span>
    </div>
    <div class="w-5/9 mx-auto">
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="flex">
                <div class="text-center w-3/5 bg-white border-1 border-solid border-gray-200 rounded-sm">
                    <input type="file" name="" id="" class="w-full">
                </div>
                <div class="flex flex-col text-left ml-5 text-lg w-2/5">
                    <label for="item_name">
                        商品名
                    </label>
                    <input type="text" name="" id="item_name"
                        class="bg-white border-1 border-solid border-gray-200 rounded-sm" placeholder="ショートケーキ">
                    <span class="text-red-500">エラーメッセージ</span>
                    <label class="mt-2" for="item_price">
                        金額税込み
                    </label>
                    <input type="number" name="" id="item_price"
                        class="bg-white border-1 border-solid border-gray-200 rounded-sm" placeholder="480"
                        min="300" max="10000" step="10">
                    <span class="text-red-500">エラーメッセージ</span>
                </div>
            </div>
            <div class="text-left pl-2">
                <span class="text-red-500">エラーメッセージ</span>
            </div>
            <div class="text-left pt-7 pb-10 w-full">
                <label class="pl-2" for="item_description">商品説明</label>
                <textarea name="" id="item_description" class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                    placeholder="ほのかな酸味の苺とあっさりしてコクのある生クリームを使用した、甘すぎないショートケーキです。"></textarea>
                <span class="text-red-500">エラーメッセージ</span>
                <div class="text-center pt-5">
                    <x-button.brown message="商品を登録" />
                </div>
            </div>
        </form>
    </div>
</x-layouts.app.header>
