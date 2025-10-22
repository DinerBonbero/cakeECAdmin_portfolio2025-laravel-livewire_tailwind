<div class="@if ($saleHistory->is_shipped === 0) bg-red-500 @endif">
    <div class="flex">
        <div class="text-right w-2/4 pr-5">
            <span class="text-lg">{{ $saleHistory->date->format('Y年m月d日') }}</span>{{-- $saleHistory->date 文字型のためモデルファイルでdatetimeキャスト --}}
        </div>
        <div class="text-right w-2/4">
            <span class="pr-5">
                {{ $saleHistory->user->user_info->last_name }}{{ $saleHistory->user->user_info->first_name }}様
            </span>
        </div>
    </div>
    @foreach ($saleHistory->order_details as $order_detail)
        @php
            $subtotal = $order_detail->item->price * $order_detail->item_num;
            $total += $subtotal;
            $orderDetailNum++;
        @endphp
        <div class="flex mt-2">
            <div class="w-2/9 flex items-center">
                @if ($orderDetailNum === 1)
                    <div class="mx-auto">
                        <form wire:submit="update">
                            @if ($saleHistory->is_shipped === 1)
                                <button type="submit"
                                    class="py-3 px-7 bg-red-500 text-white rounded-xl border-3 border-solid border-gray-200">
                                    未発送にする
                                </button>
                            @elseif ($saleHistory->is_shipped === 0)
                                <button type="submit"
                                    class="py-3 px-7 bg-indigo-500 text-white rounded-xl border-3 border-solid border-gray-200">
                                    発送済みにする
                                </button>
                            @endif
                        </form>
                    </div>
                @endif
            </div>
            <div class="w-3/9">
                <img class="w-2/3 mx-auto" src="{{ asset('storage/images/' . $order_detail->item->image) }}">
            </div>
            <div class="flex flex-col w-4/9 pr-30">
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
        <span class="mr-4">合計(税込み)</span><span>{{ number_format($total) }}</span><span>円</span>
    </div>
</div>
