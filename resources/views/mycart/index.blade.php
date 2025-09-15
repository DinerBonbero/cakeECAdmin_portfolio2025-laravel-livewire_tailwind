{{-- @php
    dd($items);
    exit();
@endphp --}}
@php
    $total = 0;
@endphp
@can('user')
    <x-layouts.app.header>
        <div class="py-5">
            <span class="text-2xl">カート内の商品</span>
        </div>
        <div class="w-3/5 mx-auto">
            @foreach ($cartItems as $cartItem)
                @php
                    $subtotal = $cartItem->item->price * $cartItem->item_num;
                    $total += $subtotal;
                @endphp
                <div class="flex mt-3">
                    <img class="w-1/4" src="{{ asset('/images/' . $cartItem->item->image) }}">
                    <div class="flex flex-col ml-20 w-full text-left">
                        <span class="mt-2">{{ $cartItem->item->name }}</span>
                        <div class="w-full">
                            <div class="mt-5 w-full">
                                <form action="{{ route('mycart_item.update', $cartItem) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <input type="number" id="item_num" name="item_num"
                                        value="{{ old('item_num', $cartItem->item_num) }}" min="1" max="10"
                                        step="1"
                                        class="w-3/11 bg-white border-3 border-solid border-gray-300 rounded-sm text-center">
                                    <label for="item_num" class="mx-1 inline">個</label>
                                    <button class="inline mx-1 py-1 w-4/11 bg-lime-500 text-white rounded-xl border-3 border-solid border-gray-200">
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
                <div class="border-b-3 border-solid border-gray-200 flex justify-between">
                    <span></span>
                    <span class="text-rose-500">エラーメッセージ</span>
                    <span>{{ '小計(税込み)' . ' ' . number_format($subtotal) . '円' }}</span>
                </div>
            @endforeach
            <div class="mb-7 border-b-3 border-solid border-gray-200 text-right text-xl">
                {{ '合計(税込み)' . '　' . number_format($total) . '円' }}
            </div>
            <div class="text-center pb-10 w-full">
                <x-button.return message="戻る" href="{{ url()->previous() }}" />
                <a href="{{ route('order.confirm') }}" class="py-1 px-10 bg-[#7cc7f4] text-white rounded-lg w-full border-3 border-solid border-gray-200">
                    注文
                </a>
            </div>
        </div>
    </x-layouts.app.header>
@endcan
