<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;

class CartController extends Controller
{
    public function store(Item $item, Request $request)
    {
        Cart::create(['user_id' => auth()->id], ['item_id' => $item->id], ['item_num' => $request->item]);
    }
}
