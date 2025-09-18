<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function confirm()
    {
        $cartItems = Cart::with('item')->whereRelation('item', 'is_pending', 0)->where('user_id', Auth::id())->latest('id')->get(); // テーブルが複数か単数か気を付ける
        // latest「最新の」
        // dd($items);
        // exit();
        $userInfo = UserInfo::where('user_id', Auth::id())->first();
        $mail = User::where('id', Auth::id())->value('email');
        // dd($mail);
        // exit();

        return view('order.confirm', compact('cartItems', 'userInfo', 'mail'));
    }

    public function store()
    {
        // $cartItems = Cart::with('item')->whereRelation('item', 'is_pending', 0)->where('user_id', Auth::id())->latest('id')->get(); //テーブルが複数か単数か気を付ける

        // foreach ($cartItems as $cartItem) {
        //     $item = $cartItem->item;
        //     $item->update([
        //         'is_pending' => 1,
        //     ]);
        // }

        // Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('order.thank_you');
    }

    public function thankYou()
    {
        return view('order.thank_you');
    }
}
