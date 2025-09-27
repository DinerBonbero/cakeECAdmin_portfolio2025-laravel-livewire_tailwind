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
                        $orderDetailNum = 0;
                    @endphp
                    <livewire:Salelist :saleHistory="$saleHistory" :orderDetailNum="$orderDetailNum" :total="$total"/>
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
