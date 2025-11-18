<div>
    <form action="{{ route('mycart_item.update', $cartItem) }}" method="POST">
        @method('PATCH')
        @csrf
        <input type="number" id="item_num" name="item_num[{{ $cartItem->id }}]"
            value="{{ old('item_num.' . $cartItem->id, $cartItem->item_num) }}" min="1" max="10" step="1"
            class="w-3/11 bg-white border-3 border-solid border-gray-300 rounded-sm text-center">
        {{-- formのnameが同一によりエラーメッセージが一つにまとまってしまうため、nameを配列に変更item_num[{{ $cartItem->id }}] --}}
        <label for="item_num" class="mx-1 inline">個</label>
        <x-button.simple message="数量更新" class="bg-lime-500 w-4/11 inline"/>
        {{-- <button class="inline mx-1 py-1 w-4/11 bg-lime-500 text-white rounded-xl border-3 border-solid border-gray-200">
            数量更新
        </button> --}}
    </form>
</div>