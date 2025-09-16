<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function confirm()
    {
        $cartItems = Cart::with('item')->whereRelation('item', 'is_pending', 0)->where('user_id', Auth::id())->latest('id')->get(); //テーブルが複数か単数か気を付ける
        //latest「最新の」
        //dd($items);
        // exit();
        return view('order.confirm', compact('cartItems'));
    }
}
