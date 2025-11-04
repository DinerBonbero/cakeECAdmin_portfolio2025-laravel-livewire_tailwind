<x-layouts.app.header>
    <div class="pt-5">
        <span class="text-emerald-500 text-2xl">管理者</span>
    </div>
    <div class="pb-5">
        <span class="text-[14px] min-[360px]:text-base md:text-xl lg:text-2xl">販売履歴一覧</span>
    </div>
    <div class="w-14/15 lg:w-9/11 text-[10px] min-[360px]:text-xs md:text-base bg-green-100 border-2 border-solid border-cyan-800 mx-auto p-2 mb-2">
        {{-- 検索フォームのレイアウト、発送状況のチェックボックス、表示する期間の入力欄、購入者名の入力欄 --}}
        <form action="{{ route('sales.history') }}" method="GET">
            <div class="grid grid-cols-3 grid-rows-1 gap-1">
                <div>
                    <span>発送状況</span>
                    <div class="grid grid-cols-1 grid-rows-2 min-[680px]:grid-cols-2 min-[680px]:grid-rows-1 gap-2">
                        <div class="text-left min-[680px]:text-center ml-4 min-[680px]:ml-0">
                            <input type="checkbox" name="un_shipped" value="0"
                                class="bg-white border-1 border-solid border-gray-300 rounded-sm cursor-pointer"
                                {{ old('un_shipped') === '0' ? 'checked' : '' }}
                                {{ isset($validatedSearchInputs['un_shipped']) ? 'checked' : '' }}>
                            未発送
                        </div>
                        <div class="text-left min-[680px]:pl-5 min-[680px]:text-center ml-4 min-[680px]:ml-0">
                            <input type="checkbox" name="shipped" value="1"
                                class="bg-white border-1 border-solid border-gray-300 rounded-sm cursor-pointer"
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
                <div>
                    <span>表示する期間</span>
                    <div class="grid grid-cols-1 min-[1360px]:grid-cols-3">
                        <input type="date" name="start_date"
                            class="bg-white border-1 border-solid border-gray-300 rounded-sm cursor-pointer"
                            value="{{ old('start_date') }}{{ $validatedSearchInputs['start_date'] ?? '' }}">
                            {{-- $validatedSearchInputs['start_date']が存在する場合はその値(ユーザーが以前入力した値)を表示し、存在しない場合は空文字を表示 --}}
                            {{-- 属性内に@を空白や改行が入りinput type="date"の型(HTMLのYYYY-MM-DD形式,phpではformat('Y-m-d'))が崩れてしまうため、value内ではnull合体演算子を使用する --}}
                        <span>～</span>
                        <input type="date" name="end_date"
                            class="bg-white border-1 border-solid border-gray-300 rounded-sm cursor-pointer"
                            value="{{ old('end_date') }}{{ $validatedSearchInputs['end_date'] ?? '' }}">
                            {{-- $validatedSearchInputs['end_date']が存在する場合はその値(ユーザーが以前入力した値)を表示し、存在しない場合は空文字を表示 --}}
                            {{-- 属性内に@を空白や改行が入りinput type="date"の型(HTMLのYYYY-MM-DD形式,phpではformat('Y-m-d'))が崩れてしまうため、value内ではnull合体演算子を使用する --}}
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
                <div>
                    <span>購入者名</span>
                    <div class="grid grid-cols-1 min-[1360px]:grid-cols-2">
                        <div>
                            <input type="text" name="purchaser_name" class="w-full bg-white border-1 border-solid border-gray-300 rounded-sm"
                                value="{{ $purchaserName ?? '' }}">
                            {{-- $purchaserNameが存在する場合はその値(ユーザーが以前入力した値)を表示し、存在しない場合は空文字を表示 --}}
                        </div>
                        <div class="text-[8px] text-center mt-1 min-[1360px]:mt-0 min-[1360px]:text-xs min-[1360px]:text-left">
                            <button class="bg-[#7cc7f4] p-1 px-2 text-white rounded-md border-3 border-solid border-gray-200">
                                この条件で検索する
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="w-13/14 sm:w-6/8 lg:w-5/8 mx-auto text-[12px] min-[360px]:text-base md:text-xl">
        {{-- 販売履歴一覧 --}}
        @if ($saleHistories->isEmpty())
            <p class="text-center mt-10 p-5 bg-lime-100">販売履歴がありません</p>
        @else
            <div class="text-center w-1/4">
                <span>発送済み</span>
            </div>
            @foreach ($saleHistories as $saleHistory)
                @php
                    $total = 0;
                    $orderDetailNum = 0;
                    // 注文レコード分ループのたびに$totalと$orderDetailNumを0に初期化
                @endphp
                <livewire:Salelist :saleHistory="$saleHistory" :orderDetailNum="$orderDetailNum" :total="$total" />
                {{-- 注文レコードのループのたびにLivewireコンポーネントを呼び出す、0に設定した$orderDetailNum、$totalを渡す --}}
            @endforeach
            <div class="flex justify-center my-5">
                <span>
                    {{ $saleHistories->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    {{-- 検索後のページネーションでも、検索クエリパラメータを維持するためにappends(request()->query())を記述 --}}
                </span>
            </div>
        @endif
    </div>
</x-layouts.app.header>
