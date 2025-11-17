<x-layouts.app.header>
    <div class="py-5">
        @can('is_admin')
            <span class="text-emerald-500 text-2xl">管理者</span>
        @endcan
    </div>
    <div class="w-15/16 min-[570px]:w-7/9 md:w-5/9 mx-auto">
        <div class="flex mb-7">
            <img class="w-1/2" src="{{ asset('storage/images/' . $item->image) }}">
            <div class="flex flex-col text-left ml-5 text-xs min-[570px]:text-base md:text-lg w-full">
                <span class="mt-1">{{ $item->name }}</span>
                <span class="mt-4 mb-4">{{ '(税込み)' . ' ' . number_format($item->price) . '円' }}</span>
                @auth
                    @can('user')
                        <form action="{{ route('mycart_item.store', $item) }}" method="POST">
                            @csrf
                            <x-button.simple message="カートに入れる" class="bg-[#7cc7f4] w-full"/>
                        </form>
                    @endcan
                    @can('is_admin')
                        <form action="{{ route('items.destroy', $item) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <x-button.simple message="商品掲載停止" class="bg-red-500 w-full"/>
                        </form>
                    @endcan
                @else
                    @guest
                        <div class="mt-4">
                            <x-button.simple message="カートに入れる" class="bg-gray-300 w-full" disabled/>
                            <p class="text-red-500 text-xs min-[570px]:text-base">カートに入れるにはログインまたは新規登録してください</p>
                        </div>
                    @endguest
                @endauth
            </div>
        </div>
        <div class="text-center pb-10 w-full text-xs min-[570px]:text-base">
            <p class="pb-5">{{ $item->description }}</p>
            <x-button.link message="戻る" href="{{ route('items.index') }}" class="bg-[#e2bc96] w-full"/>
        </div>
    </div>
</x-layouts.app.header>
