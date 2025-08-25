<x-layouts.app.header>
    @foreach ($items as $item)
        <div>{{ $item->name }}</div>
    @endforeach
</x-layouts.app.header>
