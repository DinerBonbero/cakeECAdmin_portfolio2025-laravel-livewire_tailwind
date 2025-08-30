<x-layouts.app.header>
    <div class="py-10">
        @can('is_admin')
            <span class="text-emerald-500 text-2xl">管理者</span>
        @endcan
    </div>
    <div class="w-2/3 mx-auto">
        <img class="w-1/2" src="{{ asset('/images/' . $item->image) }}">
        <div class="flex flex-col">
        <span>{{ $item->name }}</span>
        <span>{{ $item->price }}</span>
        <span><x-button.></span>
        </div>
    </div>
</x-layouts.app.header>
