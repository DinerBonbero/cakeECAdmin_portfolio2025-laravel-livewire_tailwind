@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center font-serif">
    <flux:heading size="xl" class="text-gray-500">{{ $title }}</flux:heading>
    <flux:subheading>{{ $description }}</flux:subheading>
</div>
