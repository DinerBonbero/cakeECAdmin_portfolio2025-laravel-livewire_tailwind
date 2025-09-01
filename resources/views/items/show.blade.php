<x-layouts.app.header>
    <div class="py-10">
        @can('is_admin')
            <span class="text-emerald-500 text-2xl">管理者</span>
        @endcan
    </div>
    <div class="w-5/9 mx-auto">
        <div class="flex mb-7">
            <img class="w-1/2" src="{{ asset('/images/' . $item->image) }}">
            <div class="flex flex-col text-left ml-5 text-lg w-full">
                <span class="mt-1">{{ $item->name }}</span>
                <span class="mt-4 mb-4">{{ '(税込み)' . ' ' . number_format($item->price) . '円' }}</span>
                @auth
                    @can('user')
                    <form action="{{ route('mycart_item.store', $item) }}" method="POST">
                            @csrf
                            <input type="hidden" name="item" value="1">
                            <x-button.add-item />
                        </form>
                    @endcan
                    @can('is_admin')
                        <form action="{{ route('items.destroy', $item) }}" method="POST">
                            @csrf
                            <input type="hidden" name="item" value="1">
                            <x-button.pending-item />
                        </form>
                    @endcan
                @else
                    @guest
                        <div class="mt-4">
                            <x-button.add-item />
                            <p class="text-red-500 text-base">カートに入れるにはログインまたは新規登録してください</p>
                        </div>
                    @endguest
                @endauth
            </div>
        </div>
        <div class="text-center pb-20">
            <p>{{ $item->description }}</p>
        </div>
    </div>
</x-layouts.app.header>
