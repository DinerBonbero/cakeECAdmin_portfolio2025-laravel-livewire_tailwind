@guest
    <x-layouts.app.guest-header>
        <div class="grid grid-cols-3 gap-10">
            @foreach ($items as $item)
                <div class="bg-white p-1">
                    <img src="{{ asset('images/' . $item->image) }}">
                    <div class="flex">
                        <span class="flex-none mx-2">{{ $item->name }}</span>
                        <span class="flex-1">{{ '(税込み)' . ' ' . number_format($item->price) . '円' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center my-5">
            <span>
                {{ $items->onEachSide(1)->links('vendor.pagination.tailwind') }}
            </span>
        </div>
    </x-layouts.app.guest-header>
@endguest

@auth
    <x-layouts.app.login-header>
        <div class="grid grid-cols-3 gap-10">
            @foreach ($items as $item)
                <div class="bg-white p-1">
                    <img src="{{ asset('images/' . $item->image) }}">
                    <div class="flex">
                        <span class="flex-none mx-2">{{ $item->name }}</span>
                        <span class="flex-1">{{ '(税込み)' . ' ' . number_format($item->price) . '円' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center my-5">
            <span>
                {{ $items->onEachSide(1)->links('vendor.pagination.tailwind') }}
            </span>
        </div>
    </x-layouts.app.guest-header>
@endauth
