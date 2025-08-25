<x-layouts.app.guest-header>
    @foreach ($items as $item)
        <div>{{ $item->name }}</div>
    @endforeach
</x-layouts.app.guest-header>
