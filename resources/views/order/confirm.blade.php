{{-- @php
    var_dump($errors);
    exit();
@endphp --}}
@php
    $total = 0;
@endphp
@can('user')
    <x-layouts.app.header>
        <div class="py-3">
            <span class="text-2xl">カート内の商品</span>
        </div>
        <div class="w-4/7 mx-auto">
            @foreach ($cartItems as $cartItem)
                @php
                    $subtotal = $cartItem->item->price * $cartItem->item_num;
                    $total += $subtotal;
                @endphp
                <div class="flex mt-2">
                    <img class="w-1/5" src="{{ asset('/images/' . $cartItem->item->image) }}">
                    <div class="flex flex-col ml-20 w-full">
                        <span class="mt-2">{{ $cartItem->item->name }}</span>
                        <div class="w-full">
                            <div class="mt-5 w-full text-center">
                                <span class="w-3/11">{{ $cartItem->item_num }}</span>
                                {{-- formのnameが同一によりエラーメッセージが一つにまとまってしまうため、nameを配列に変更item_num[{{ $cartItem->id }}] --}}
                                <span for="item_num" class="mx-1 inline">個</span>
                                {{-- <button class="inline mx-1 py-1 w-4/11 bg-lime-500 text-white rounded-xl border-3 border-solid border-gray-200">
                                        数量更新
                                    </button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div></div>
                    </div>
                </div>
                <div class="border-b-3 border-solid border-gray-200 flex justify-between">
                    <span></span>
                    {{-- エラーメッセージの表示 --}}
                    {{-- 配列に変更したため、エラーメッセージの表示も変更 @error('item_num.' . $cartItem->id)ドットを付けてitem_num[{{ $cartItem->id }}]のエラー呼び出し --}}
                    @error('item_num.' . $cartItem->id)
                        <span class="text-rose-500">{{ $message }}</span>
                    @enderror
                    <span>{{ '小計(税込み)' . ' ' . number_format($subtotal) . '円' }}</span>
                </div>
            @endforeach
            <div class="mb-7 border-b-3 border-solid border-gray-200 text-right text-xl">
                {{ '合計(税込み)' . '　' . number_format($total) . '円' }}
            </div>
            <div class="text-center pb-10 w-full">
                <x-button.return message="戻る" href="{{ url()->previous() }}" />
                <a href="{{ route('order.confirm') }}"
                    class="ml-2 py-1 px-10 bg-[#7cc7f4] text-white rounded-lg w-full border-3 border-solid border-gray-200">
                    注文
                </a>
            </div>
        </div>
    </x-layouts.app.header>
@endcan
