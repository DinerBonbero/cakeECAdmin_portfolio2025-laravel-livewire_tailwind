{{-- @php
    dd($saleHistories);
    exit();
@endphp --}}

@can('is_admin')
    <x-layouts.app.header>
        <div class="pt-5">
            <span class="text-emerald-500 text-2xl">管理者</span>
        </div>
        <div class="pb-5">
            <span class="text-xl">販売履歴一覧</span>
        </div>
        <div class="w-5/8 mx-auto">
            @if ($saleHistories->isEmpty())
                <p class="text-center mt-10 p-5 bg-lime-100">販売履歴がありません</p>
            @else
                <div class="text-center w-1/4 text-xl">
                    <span>発送済み</span>
                </div>
                @foreach ($saleHistories as $saleHistory)
                    @php
                        $total = 0;
                    @endphp
                    <div class="flex mt-1">
                        <div class="text-left w-1/4">
                            <span class="text-lg">{{ $saleHistory->date->format('Y年m月d日') }}</span>{{-- {{var_dump($saleHistory->date)}}文字型のためモデルファイルでdatetimeキャスト --}}
                        </div>
                        <div class="text-right w-full">
                            <span>{{ $saleHistory->user->user_info->last_name }}{{ $saleHistory->user->user_info->first_name }}</span>
                        </div>
                    </div>
                    @foreach ($saleHistory->order_details as $order_detail)
                        @php
                            $subtotal = $order_detail->item->price * $order_detail->item_num;
                            $total += $subtotal;
                        @endphp
                        <div class="flex mt-2">
                            <div class="w-2/9 flex items-center">
                                <form wire:submit="update" name="is_shipped">
                                    <livewire:UpdateShippingStatusButton :saleHistory="$saleHistory->id" />
                                </form>
                            </div>
                            <div  class="w-3/9">
                                <img class="w-2/3 mx-auto" src="{{ asset('/images/' . $order_detail->item->image) }}">
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
                        <div class="border-b-3 border-solid border-gray-200 flex justify-between">
                            <span></span>
                            <span>{{ '小計(税込み)' . ' ' . number_format($subtotal) . '円' }}</span>
                        </div>
                    @endforeach
                    <div class="border-b-3 border-solid border-[#e2bc96] text-right text-lg">
                        {{ '合計(税込み)' . '　' . number_format($total) . '円' }}
                    </div>
                @endforeach
                <div class="flex justify-center my-5">
                    <span>
                        {{ $saleHistories->onEachSide(1)->links('vendor.pagination.tailwind') }}
                    </span>
                </div>
            @endif
        </div>
    </x-layouts.app.header>
@endcan
