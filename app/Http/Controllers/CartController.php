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
        $cartItems = Cart::with('item')->whereRelation('item', 'is_pending', 0)->where('user_id', Auth::id())->latest('id')->get();//テーブルが複数か単数か気を付ける
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
        $cart = Cart::where('user_id', Auth::id())->where('item_id', $item->id)->first();
        dd($cart);
        exit();
        $cart->update([
            'item_num' => $request->item_num
        ]);

        return redirect()->back();
    }

    public function destroy(Cart $item){
        
        Cart::where('user_id', Auth::id())->find($item->id)->delete();

        return redirect()->back();
    }
}
