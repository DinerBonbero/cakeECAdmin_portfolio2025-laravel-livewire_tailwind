{{-- @php
    if (isset($validatedSearchInputs)) {
        dd($validatedSearchInputs);
        exit();
    }
@endphp --}}
<x-layouts.app.header>
    <div class="pt-5">
        <span class="text-emerald-500 text-2xl">管理者</span>
    </div>
    <div class="pb-5">
        <span class="text-xl">販売履歴一覧</span>
    </div>
    <div class="w-7/9 bg-green-100 border-2 border-solid border-cyan-800 mx-auto p-2 mb-2">
        <form action="{{ route('sales.history') }}" method="GET">
            <div class="flex justify-between">
                <div class="flex flex-col">
                    <span>発送状況</span>
                    <div class="flex justify-between">
                        <div>
                            <input type="checkbox" name="un_shipped" value="0"
                                class="bg-white border-1 border-solid border-gray-300 rounded-sm"
                                {{ old('un_shipped') === '0' ? 'checked' : '' }}
                                {{ isset($validatedSearchInputs['un_shipped']) ? 'checked' : '' }}>
                            未発送
                        </div>
                        <div class="pl-5">
                            <input type="checkbox" name="shipped" value="1"
                                class="bg-white border-1 border-solid border-gray-300 rounded-sm"
                                {{ old('shipped') === '1' ? 'checked' : '' }}
                                {{ isset($validatedSearchInputs['shipped']) ? 'checked' : '' }}>
                            発送済み
                        </div>
                    </div>
                    @error('un_shipped')
                        <div class="text-left">
                            <span class="text-red-500">{{ $message }}</span>
                        </div>
                    @enderror
                    @error('shipped')
                        <div class="text-left">
                            <span class="text-red-500">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <span>表示する期間</span>
                    <div>
                        <input type="date" name="start_date"
                            class="bg-white border-1 border-solid border-gray-300 rounded-sm"
                            value="{{ old('start_date') }}{{ $validatedSearchInputs['start_date'] ?? '' }}">
                        <span>～</span>
                        <input type="date" name="end_date"
                            class="bg-white border-1 border-solid border-gray-300 rounded-sm"
                            value="{{ old('end_date') }}{{ $validatedSearchInputs['end_date'] ?? '' }}">
                    </div>
                    @error('start_date')
                        <div class="text-left">
                            <span class="text-red-500">{{ $message }}</span>
                        </div>
                    @enderror
                    @error('end_date')
                        <div class="text-left">
                            <span class="text-red-500">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <span>購入者名</span>
                    <input type="text" name="purchaser_name"
                        class="bg-white border-1 border-solid border-gray-300 rounded-sm"
                        value="{{ $purchaserName ?? '' }}">
                </div>
                <div>
                    <button class="bg-[#7cc7f4] p-1 px-2 text-white rounded-md border-3 border-solid border-gray-200">
                        この条件で検索する
                    </button>
                </div>
            </div>
        </form>
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
                    $orderDetailNum = 0;
                @endphp
                <livewire:Salelist :saleHistory="$saleHistory" :orderDetailNum="$orderDetailNum" :total="$total" />
            @endforeach
            <div class="flex justify-center my-5">
                <span>
                    {{ $saleHistories->appends(request()->query())->onEachSide(1)->links('vendor.pagination.tailwind') }}
                </span>
            </div>
        @endif
    </div>
</x-layouts.app.header>
