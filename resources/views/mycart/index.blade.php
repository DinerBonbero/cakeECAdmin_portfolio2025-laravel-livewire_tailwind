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
                    <div class="flex flex-col ml-25 w-full text-left">
                        <span class="mt-2">{{ $cartItem->item->name }}</span>
                        <div class="w-full">
                            <div class="mt-5 inline-block relative w-4/11">
                                <button class="text-gray-400 text-2xl absolute left-2">
                                    -
                                </button>
                                <input readonly type="number" id="item_num" name="item_num"
                                    value="{{ old('item_num', $cartItem->item_num) }}" min="1" max="10"
                                    step="1"
                                    class="w-full bg-white border-3 border-solid border-gray-300 rounded-sm text-center hide-spin">
                                <button class="text-gray-400 text-2xl absolute right-2">
                                    +
                                </button>
                            </div>
                            {{-- <livewire:CartItemNum :cartItem="$cartItem" /> --}}
                            <label for="item_num" class="ml-10">個</label>
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
                        <span class="mt-4">{{ '小計(税込み)' . ' ' . number_format($subtotal) . '円' }}</span>
                    </div>
                </div>
                <div class="py-1 text-rose-500 border-b-3 border-solid border-gray-200">
                    <span class="mr-30">エラーメッセージ</span>
                </div>
            @endforeach
            <div class="mb-7 border-b-3 border-solid border-gray-200 text-right text-xl">
                {{ '合計(税込み)' . '　' . number_format($total) . '円' }}
            </div>

            <div class="text-center pb-10 w-full">
                <x-button.return message="戻る" href="{{ url()->previous() }}" />
            </div>
        </div>
    </x-layouts.app.header>
@endcan
