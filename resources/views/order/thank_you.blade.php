{{-- @php
    dd($orders);
    exit();
@endphp --}}
@php
    $total = 0;
    foreach ($orders->order_details as $order_details) {
        $total += $order_details->item->price * $order_details->item_num;
    }
@endphp
@can('user')
    <x-layouts.app.header>
        <div class="w-5/8 mx-auto">
            <div class="p-10 my-10 bg-white font-serif text-gray-800 border-1 border-solid border-gray-200">
                <p class="mb-3 text-2xl">購入完了しました。</p>
                <p>弊社のお菓子をお買い求め頂きありがとうございます。</p>
                <p>お支い払金額は<span class="font-mono">{{ $total }}</span>円です。</p>
            </div>
            <x-button.brown-link message="ホームに戻る" href="{{ route('items.index') }}" />
        </div>
    </x-layouts.app.header>
@endcan
