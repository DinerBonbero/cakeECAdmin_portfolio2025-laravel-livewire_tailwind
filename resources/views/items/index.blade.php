<x-layouts.app.guest>
    @foreach ($items as $item)
        <div>{{ $item->name }}</div>
    @endforeach
</x-layouts.app.guest>
