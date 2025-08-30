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
                <form action="@can('user') route('mycart_item.store') @endcan @can('is_admin') route('items.destroy') @endcan" method="post">
                    @csrf
                    <input type="hidden" name="item" value="1">
                    @auth
                        @can('user')
                            <x-button.add-item />
                        @endcan

                        @can('is_admin')
                            <x-button.pending-item />
                        @endcan
                    @else
                        @guest
                            <x-button.add-item />
                        @endguest

                    @endauth
                </form>
                <div class="mt-4">
                    @guest
                        <p class="text-red-500 text-base">カートに入れるにはログインまたは新規登録してください</p>
                    @endguest
                </div>
            </div>
        </div>
        <div class="text-center pb-20">
            <p>{{ $item->description }}</p>
        </div>
    </div>
</x-layouts.app.header>
