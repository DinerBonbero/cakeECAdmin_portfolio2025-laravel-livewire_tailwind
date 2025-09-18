<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        try {

            DB::transaction(function () {

                Cart::where('user_id', Auth::id())->delete();

                Order::create([
                    'login_id' => login_id,
                    'password' => password,
                ]);
            }, 5);
        } catch (\Exception $e) {
            Log::error('購入時のエラー');
        }

        return redirect()->route('order.thank_you');
    }

    public function thankYou()
    {
        return view('order.thank_you');
    }
}
