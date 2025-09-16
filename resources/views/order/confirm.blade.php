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
        <div class="w-5/8 mx-auto">
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
                                <span for="item_num" class="mx-1 inline">個</span>
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
                    <span>{{ '小計(税込み)' . ' ' . number_format($subtotal) . '円' }}</span>
                </div>
            @endforeach
            <div class="border-b-3 border-solid border-gray-200 text-right text-lg">
                {{ '合計(税込み)' . '　' . number_format($total) . '円' }}
            </div>
            <div class="text-right mt-2">
                <x-button.brown-link message="カートの修正" href="{{ route('mycart_item.index') }}" />
            </div>
            <div class="py-1">
                <span class="text-2xl">送り先</span>
            </div>
            <div class="flex border-b-3 border-solid border-gray-200">
                <span>お名前</span>
                <span>{{ $userInfo->last_name }}{{ $userInfo->first_name }}</span>
            </div>
            <div class="flex border-b-3 border-solid border-gray-200">
                <span>ご住所</span>
                <div class="flex border-b-3 border-solid border-gray-200 flex-col ml-3">
                    <span>{{ '〒' . $userInfo->postal_code }}</span>
                    <div>
                        <span>{{ $userInfo->prefecture }}</span>
                        <span>{{ $userInfo->street_address }}</span>
                        <span>{{ $userInfo->address_detail }}</span>
                    </div>
                </div>
            </div>
            <div class="flex border-b-3 border-solid border-gray-200">
                <span>電話番号</span>
                <span>{{ $userInfo->phone_number }}</span>
            </div>
            <div class="flex border-b-3 border-solid border-gray-200">
                <span>メールアドレス</span>
                <span>{{ $mail }}</span>
            </div>
            <div class="text-right mt-2">
                <x-button.brown-link message="送り先修正" href="{{ route('mycart_item.index') }}" />
            </div>
            <div class="w-1/5 mx-auto mt-10 mb-5">
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <x-button.blue message="注文確定" />
                </form>
            </div>
        </div>
    </x-layouts.app.header>
@endcan
