<x-layouts.app.header>
    <div class="py-5">
        @can('is_admin')
            <span class="text-emerald-500 text-2xl">管理者</span>
        @endcan
    </div>
    <div class="grid grid-cols-1 min-[450px]:grid-cols-2 min-[850px]:grid-cols-3 gap-1 min-[400px]:gap-3 min-[850px]:gap-10 mx-4 min-[530px]:mx-7 text-xs min-[530px]:text-sm min-[1000px]:text-base">
        @foreach ($items as $item)
            <a href="{{ route('items.show', $item) }}">
                <div class="bg-white p-1">
                    <img src="{{ asset('storage/images/' . $item->image) }}">
                    <div class="flex">
                        <span class="flex-none mx-2">{{ $item->name }}</span>
                        <span class="flex-1">{{ '(税込み)' . ' ' . number_format($item->price) . '円' }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div class="flex justify-center my-5">
        <span>
            {{ $items->links('vendor.pagination.tailwind') }}
        </span>
    </div>
</x-layouts.app.header>
