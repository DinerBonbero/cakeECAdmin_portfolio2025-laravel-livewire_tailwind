<button wire:click="decrement({{ $cartItem->item_id }})" class="text-gray-400 text-2xl absolute left-2">
    -
</button>
<input readonly type="number" id="item_num" name="item_num" value="{{ old('item_num', $cartItem->item_num) }}"
    min="1" max="10" step="1"
    class="w-full bg-white border-3 border-solid border-gray-300 rounded-sm text-center hide-spin">
<button wire:click="increment({{ $cartItem->item_id }})" class="text-gray-400 text-2xl absolute right-2">
    +
</button>
