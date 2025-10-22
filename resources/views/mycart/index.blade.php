@php
    $total = 0;
    $previousUrl = url()->previous();
    $currentUrl = url()->current();
    if ($previousUrl === $currentUrl) {
        $previousUrl = route('items.index');
        //無限ループ防止のため、直前のURLが現在のURLと同じ場合は商品一覧画面に遷移
    }
@endphp
<x-layouts.app.header>
    <div class="py-5">
        <span class="text-2xl">カート内の商品</span>
    </div>
    <div class="w-3/5 mx-auto">
        @if ($cartItems->isEmpty())
            <p class="text-center mt-10 p-5 bg-lime-100">カートに商品が入っていません。</p>
        @else
            @foreach ($cartItems as $cartItem)
                @php
                    $subtotal = $cartItem->item->price * $cartItem->item_num;
                    $total += $subtotal;
                @endphp
                <div class="flex mt-3">
                    <img class="w-1/4" src="{{ asset('storage/images/' . $cartItem->item->image) }}">
                    <div class="flex flex-col ml-20 w-full text-left">
                        <span class="mt-2">{{ $cartItem->item->name }}</span>
                        <div class="w-full">
                            <div class="mt-5 w-full">
                                <form action="{{ route('mycart_item.update', $cartItem) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <input type="number" id="item_num" name="item_num[{{ $cartItem->id }}]"
                                        value="{{ old('item_num.' . $cartItem->id, $cartItem->item_num) }}"
                                        min="1" max="10" step="1"
                                        class="w-3/11 bg-white border-3 border-solid border-gray-300 rounded-sm text-center">
                                    {{-- formのnameが同一によりエラーメッセージが一つにまとまってしまうため、nameを配列に変更item_num[{{ $cartItem->id }}] --}}
                                    <label for="item_num" class="mx-1 inline">個</label>
                                    <button
                                        class="inline mx-1 py-1 w-4/11 bg-lime-500 text-white rounded-xl border-3 border-solid border-gray-200">
                                        数量更新
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <form action="{{ route('mycart_item.destroy', $cartItem) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button
                                class="py-1 bg-rose-300 text-white rounded-xl w-3/5 border-3 border-solid border-gray-200">
                                削除
                            </button>
                        </form>
                    </div>
                </div>
                <div class="border-b-3 border-solid border-gray-200 grid grid-cols-3">
                    {{-- エラーメッセージの表示 --}}
                    {{-- 配列に変更したため、エラーメッセージの表示も変更 @error('item_num.' . $cartItem->id)ドットを付けてitem_num[{{ $cartItem->id }}]のエラー呼び出し --}}
                    @error('item_num.' . $cartItem->id)
                        <div class="col-span-1 col-start-2 col-end-3">
                            <span class="text-rose-500">{{ $message }}</span>
                        </div>
                    @enderror
                    <div class="text-right col-span-1 col-end-4">
                        {{-- cols-3の最後の列に配置したいときはcol-end-3ではなくcol-end-4と指定 --}}
                        <span class="mr-3">小計(税込み)</span><span>{{ number_format($subtotal) }}</span><span>円</span>
                    </div>
                </div>
            @endforeach
            <div class="mb-7 border-b-3 border-solid border-gray-200 text-right text-xl">
                <span class="mr-4">合計(税込み)</span><span>{{ number_format($total) }}</span><span>円</span>
            </div>
            <div class="text-center pb-10 w-full">
                <x-button.brown-link message="戻る" href="{{ $previousUrl }}" />
                {{-- 直前のページに戻る、もしリンク先が現在のページと同じ場合は商品一覧画面に遷移。無限ループ防止。
                リンクを渡せるコンポーネントを使用。 --}}
                <a href="{{ route('order.confirm') }}" class="ml-2 py-1 px-10 bg-[#7cc7f4] text-white rounded-lg w-full border-3 border-solid border-gray-200">
                    注文
                </a>
            </div>
        @endif
    </div>
</x-layouts.app.header>
