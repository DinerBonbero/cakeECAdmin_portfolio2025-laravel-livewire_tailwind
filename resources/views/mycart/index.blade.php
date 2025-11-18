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
    <div class="w-15/16 min-[420px]:w-7/9 md:w-3/5 mx-auto text-xs sm:text-base">
        @if ($cartItems->isEmpty())
            <p class="text-center mt-10 p-5 bg-lime-100">カートに商品が入っていません</p>
        @else
            @foreach ($cartItems as $cartItem)
                @php
                    $subtotal = $cartItem->item->price * $cartItem->item_num;
                    $total += $subtotal;
                @endphp
                <div class="flex mt-3">
                    <img class="w-3/13 md:w-3/9" src="{{ asset('storage/images/' . $cartItem->item->image) }}">
                    <div class="w-5/13 md:w-4/9 flex flex-col ml-2 min-[420px]:ml-5 min-[1160px]:ml-20 w-full text-left">
                        <span class="mt-2">{{ $cartItem->item->name }}</span>
                        <div class="w-full">
                            <div class="mt-5 w-full">
                                <livewire:cart-item-quantity-alert :cartItem="$cartItem" />
                            </div>
                        </div>
                    </div>
                    <div class="w-5/13 md:w-2/9">
                        <form action="{{ route('mycart_item.destroy', $cartItem) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="w-4/5">
                                <x-button.simple message="削除" class="bg-rose-300 w-full"/>
                            </div>
                            {{-- <button class="py-1 bg-rose-300 text-white rounded-xl w-3/5 border-3 border-solid border-gray-200">
                                削除
                            </button> --}}
                        </form>
                    </div>
                </div>
                <div class="border-b-3 border-solid border-gray-200 grid grid-cols-6">
                    {{-- エラーメッセージの表示 --}}
                    {{-- 配列に変更したため、エラーメッセージの表示も変更 @error('item_num.' . $cartItem->id)ドットを付けてitem_num[{{ $cartItem->id }}]のエラー呼び出し --}}
                    @error('item_num.' . $cartItem->id)
                        <div class="col-span-4 col-start-2">
                            <span class="text-rose-500">{{ $message }}</span>
                        </div>
                    @enderror
                    <div class="text-right col-span-3 col-end-7">
                        {{-- cols-4の最後の列に配置したいときはcol-end-4ではなくcol-end-5と指定 --}}
                        <span class="mr-3">小計(税込み)</span><span>{{ number_format($subtotal) }}</span><span>円</span>
                    </div>
                </div>
            @endforeach
            <div class="mb-7 border-b-3 border-solid border-gray-200 text-right mx-auto text-sm sm:text-base md:text-xl">
                <span class="mr-4">合計(税込み)</span><span>{{ number_format($total) }}</span><span>円</span>
            </div>
            <div class="text-center pb-10 w-full">
                <x-button.link message="戻る" href="{{ $previousUrl }}" class="bg-[#e2bc96] w-full"/>
                {{-- 直前のページに戻る、もしリンク先が現在のページと同じ場合は商品一覧画面に遷移。無限ループ防止。
                リンクを渡せるコンポーネントを使用。 --}}
                <x-button.link message="注文" href="{{ route('order.confirm') }}" class="bg-[#7cc7f4] w-full ml-2"/>
                {{-- <a href="{{ route('order.confirm') }}" class="ml-2 py-1 px-10 bg-[#7cc7f4] text-white rounded-lg w-full border-3 border-solid border-gray-200">
                    注文
                </a> --}}
            </div>
        @endif
    </div>
</x-layouts.app.header>
