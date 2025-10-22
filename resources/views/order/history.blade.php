<x-layouts.app.header>
    <div class="py-3">
        <span class="text-2xl">購入履歴</span>
    </div>
    <div class="w-5/8 mx-auto">
        @if ($orderHistories->isEmpty())
            <p class="text-center mt-10 p-5 bg-lime-100">注文履歴がありません</p>
        @else
            @foreach ($orderHistories as $orderHistory)
                @php
                    $total = 0;
                @endphp
                <div class="w-full text-left mt-1">
                    <span class="text-lg">{{ $orderHistory->date->format('Y年m月d日') }}</span>{{-- $orderHistory->date文字型のためモデルファイルでdatetimeキャスト --}}
                </div>
                @foreach ($orderHistory->order_details as $order_detail)
                    @php
                        $subtotal = $order_detail->item->price * $order_detail->item_num;
                        $total += $subtotal;
                    @endphp
                    <div class="flex mt-2">
                        <img class="w-1/5" src="{{ asset('storage/images/' . $order_detail->item->image) }}">
                        <div class="flex flex-col w-full mr-35">
                            <span class="mt-2">{{ $order_detail->item->name }}</span>
                            <div class="w-full">
                                <div class="mt-5 w-full text-center">
                                    <span class="w-3/11">{{ $order_detail->item_num }}</span>
                                    <span for="item_num" class="mx-1 inline">個</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-b-3 border-solid border-gray-200 text-right">
                        <span class="mr-3">小計(税込み)</span><span>{{ number_format($subtotal) }}</span><span>円</span>
                    </div>
                @endforeach
                <div class="border-b-3 border-solid border-[#e2bc96] text-right text-lg">
                    <span class="mr-3">合計(税込み)</span><span>{{ number_format($total) }}</span><span>円</span>
                </div>
            @endforeach
            <div class="flex justify-center my-5">
                <span>
                    {{ $orderHistories->onEachSide(1)->links('vendor.pagination.tailwind') }}
                </span>
            </div>
        @endif
    </div>
</x-layouts.app.header>