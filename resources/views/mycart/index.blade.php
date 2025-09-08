{{-- @php
    dd($items);
    exit();
@endphp --}}
@can('user')
    <x-layouts.app.header>
        <div class="py-10">
            <span class="text-2xl">カート内の商品</span>
        </div>
        <div class="w-3/5 mx-auto">
            @foreach ($items as $item)
                <div class="flex">
                    <img class="w-1/4" src="{{ asset('/images/' . $item->item->image) }}">
                    <div class="flex flex-col ml-10 w-full">
                        <span class="mt-2">{{ $item->item->name }}</span>
                        <div class="mt-5">
                            <input type="text" id="item_num" name="item_num"
                                value="{{ old('item_num', $item->item_num) }}"
                                class="w-1/3 bg-white border-1 border-solid border-gray-200 rounded-sm text-center">
                            <label for="item_num">個</label>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <form action="{{ route('mycart_item.destroy', $item) }}" method="POST">
                            @csrf
                            <button
                                class="py-1 bg-rose-300 text-white rounded-xl w-3/5 border-3 border-solid border-gray-200">
                                削除
                            </button>
                        </form>
                        <span class="mt-4">{{ '小計(税込み)' . ' ' . number_format($item->item->price) . '円' }}</span>
                    </div>
                </div>
                <div class="mb-7">
                    エラーメッセージ
                </div>
            @endforeach

            <div class="text-center pb-10 w-full">
                <x-button.return message="戻る" href="{{ redirect()->back() }}" />
            </div>
        </div>
    </x-layouts.app.header>
@endcan
