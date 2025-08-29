<x-layouts.app.header>
    <div class="py-10">
        @can('is_admin')
            <span class="text-emerald-500 text-2xl">管理者</span>
        @endcan
    </div>
    <div class="">
        <img src="{{ asset('/images/' . $item->image) }}">
    </div>
</x-layouts.app.header>
