@php
    dd($orders);
    exit();
@endphp
{{-- @php
    $total = 0;
    foreach ($orders as $key => ) {
            
    }
@endphp --}}
@can('user')
    <x-layouts.app.header>
        <div class="w-5/8 mx-auto">
            <div class="p-10 my-10 bg-white font-serif text-gray-800 border-3 border-solid border-gray-200">
                <p class="mb-3 text-2xl">購入完了しました。</p>
                <p>弊社のお菓子をお買い求め頂きありがとうございます。</p>
                <p>お支払金額は○あるです。</p>
            </div>
            <x-button.brown-link message="ホームに戻る" href="{{ route('items.index') }}" />
        </div>
    </x-layouts.app.header>
@endcan
