<div>
    <form action="{{ route('mycart_item.update', $cartItem) }}" method="POST">
        @method('PATCH')
        @csrf
        <input type="number" id="item_num" name="item_num[{{ $cartItem->id }}]"
            min="1" max="10" step="1"
            class="w-3/11 bg-white border-3 border-solid @if ($isUpdate === 'true') border-gray-300 @elseif($isUpdate === 'false') border-rose-500 @else border-gray-300 @endif rounded-sm text-center"
            wire:model.live="cartItemNum">
        {{-- 
        Livewireでは、クラスコンポーネントのpublicプロパティ$cartItemNumとwire:model.live="cartItemNum"が双方向に連動する。
        初期値はmount()などで $cartItemNum に代入された値がinputに反映される。
        ※Blade側のvalue="{{ old() }}" はLivewire によって無視されるため不要。
        入力時、Livewireが即座にイベントを発火し、変更された値がクラスプロパティにバインドされる。
        --}}
        {{-- value="{{ old('item_num.' . $cartItem->id, $cartItem->item_num) }}" --}}
        {{-- formのnameが同一によりエラーメッセージが一つにまとまってしまうため、nameを配列に変更item_num[{{ $cartItem->id }}] --}}
        <label for="item_num" class="mx-1 inline">個</label>
        <x-button.simple message="数量更新" class="bg-lime-500 w-4/11 inline"/>
        {{-- <button class="inline mx-1 py-1 w-4/11 bg-lime-500 text-white rounded-xl border-3 border-solid border-gray-200">
            数量更新
        </button> --}}
    </form>
</div>