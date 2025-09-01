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

        return view('mycart.index');
    }

    public function store(Item $item, Request $request)
    {
        $validated = $request->validate([
            'item' => 'required|integer|in:1',
        ]);

        Cart::create(['user_id' => Auth::id(), 'item_id' => $item->id, 'item_num' => $validated['item']]);

        return redirect()->route('mycart_item.index');
    }
}
