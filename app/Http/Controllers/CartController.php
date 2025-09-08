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
        $items = Cart::with('item')->whereRelation('item', 'is_pending', 0)->where('user_id', Auth::id())->get();//テーブルが複数か単数か気を付ける
        //dd($items);
        // exit();
        return view('mycart.index', compact('items'));
    }

    public function store(Item $item)
    {

        Cart::create(['user_id' => Auth::id(), 'item_id' => $item->id, 'item_num' => 1]);

        return redirect()->route('mycart_item.index');
    }
}
