<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('item')->whereRelation('item', 'is_pending', 0)->where('user_id', Auth::id())->latest('id')->get(); //テーブルが複数か単数か気を付ける
        //latest「最新の」
        //dd($items);
        // exit();
        return view('mycart.index', compact('cartItems'));
    }

    public function store(Item $item)
    {

        Cart::create(['user_id' => Auth::id(), 'item_id' => $item->id, 'item_num' => 1]);

        return redirect()->route('mycart_item.index');
    }

    public function update(Request $request, Item $item)
    {
        $rules = [
            'item_num' => 'required|array',
            'item_num.' . $item->id => 'required|integer|min:1|max:10',
            // 配列のnameから送られてきた値をバリデーションする場合、配列のnameをルールに指定する際は「.」でつなげて指定する
        ];

        $messages = [
            'item_num.required' => '個数を入力してください',
            'item_num.array' => 'この値は無効です',
            'item_num.' . $item->id . '.required' => '個数を入力してください',
            'item_num.' . $item->id . '.integer' => '個数は半角数字で入力してください',
            'item_num.' . $item->id . '.min' => '1以上10文字以内で入力してください',
            'item_num.' . $item->id . '.max' => '1以上10文字以内で入力してください',
            // 配列のnameから送られた値のバリデーションメッセージを指定する場合も、ルールと同様に「.」でつなげて指定する
        ];

        $validated = $request->validate($rules, $messages);

        // dd($validated);
        // exit();

        $cart = Cart::where('user_id', Auth::id())->where('id', $item->id)->first();

        $cart->update([
            'item_num' => $validated['item_num'][$item->id]
        ]);

        return redirect()->back();
    }

    public function destroy(Cart $item)
    {

        Cart::where('user_id', Auth::id())->find($item->id)->delete();

        return redirect()->back();
    }
}
