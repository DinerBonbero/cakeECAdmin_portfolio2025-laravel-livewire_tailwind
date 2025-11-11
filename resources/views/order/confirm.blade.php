@php
    $total = 0;
@endphp
<x-layouts.app.header>
    <div class="py-3">
        <span class="text-base md:text-2xl">カート内の商品</span>
    </div>
    <div class="w-7/8 md:w-5/8 mx-auto text-xs md:text-base">
        @if ($cartItems->isEmpty())
            <p class="text-center mt-10 p-5 bg-lime-100 text-base md:text-lg">カートに商品が入っていません</p>
        @else
            @foreach ($cartItems as $cartItem)
                @php
                    $subtotal = $cartItem->item->price * $cartItem->item_num;
                    $total += $subtotal;
                @endphp
                <div class="flex mt-2">
                    <img class="w-1/5" src="{{ asset('storage/images/' . $cartItem->item->image) }}">
                    <div class="flex flex-col w-full mr-35">
                        <span class="mt-2">{{ $cartItem->item->name }}</span>
                        <div class="w-full">
                            <div class="mt-5 w-full text-center">
                                <span>{{ $cartItem->item_num }}</span>
                                <span class="mx-1">個</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-b-3 border-solid border-gray-200 text-right">
                    <span class="mr-3">小計(税込み)</span><span>{{ number_format($subtotal) }}</span><span>円</span>
                </div>
            @endforeach
            <div class="border-b-3 border-solid border-gray-200 text-right text-sm md:text-lg">
                <span class="mr-4">合計(税込み)</span><span>{{ number_format($total) }}</span><span>円</span>
            </div>
            <div class="text-right mt-2">
                <x-button.brown-link message="カートの修正" href="{{ route('mycart_item.index') }}" />
            </div>
            <div class="py-1">
                <span class="text-base md:text-2xl">送り先</span>
            </div>
            <div class="w-full">
                <div class="flex justify-between w-full border-b-3 border-solid border-gray-200">
                    <span>お名前</span>
                    @if ($userInfo !== null)
                        <div class="text-left w-2/3">
                            <span>{{ $userInfo->last_name }}{{ $userInfo->first_name }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex justify-between w-full border-b-3 border-solid border-gray-200">
                    <span>ご住所</span>
                    @if ($userInfo !== null)
                        <div class="flex flex-col text-left w-2/3">
                            <span>{{ '〒' . $userInfo->postal_code }}</span>
                            <div>
                                <span class="mr-3">{{ $userInfo->prefecture }}</span>
                                <span class="mr-3">{{ $userInfo->street_address }}</span>
                                <span>{{ $userInfo->address_detail }}</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="flex justify-between w-full border-b-3 border-solid border-gray-200">
                    <span>電話番号</span>
                    @if ($userInfo !== null)
                        <div class="text-left w-2/3">
                            <span>{{ $userInfo->phone_number }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex justify-between w-full border-b-3 border-solid border-gray-200">
                    <span>メールアドレス</span>
                    @if ($userInfo !== null)
                        <div class="text-left w-2/3">
                            <span>{{ $mail }}</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-right mt-2">
                @if ($userInfo !== null)
                    <x-button.brown-link message="送り先の修正" href="{{ route('user_info.edit') }}" />
                @else
                    <x-button.brown-link message="送り先の登録" href="{{ route('user_info.create') }}" />
                @endif
            </div>

            @if ($userInfo !== null)
                <div class="w-2/6 rounded-md min-[470px]:w-1/5 mx-auto mt-10 mb-5">
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <button class="bg-[#7cc7f4] py-1 w-full text-white rounded-lg border-3 border-solid border-gray-200">
                            注文確定
                        </button>
                    </form>
                </div>
            @else
                {{-- ユーザー情報が未登録の場合、注文確定ボタンを無効化してユーザー情報登録を促すメッセージを表示 --}}
                <div class="w-2/6 min-[470px]:w-1/5 mx-auto mt-10">
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <button class="bg-gray-300 py-1 w-full text-white rounded-lg border-3 border-solid border-gray-200" disabled>
                            注文確定
                        </button>
                    </form>
                </div>
                <div class="text-center w-full mb-5">
                    <span class="text-rose-500">送り先を登録してください</span>
                </div>
            @endif
        @endif
    </div>
</x-layouts.app.header>
