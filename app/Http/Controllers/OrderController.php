<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Features\SupportConsoleCommands\Commands\CopyCommand;

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
        $userInfo = UserInfo::where('user_id', Auth::id())->first();
        if (!$userInfo) {
            return redirect()->route('order.confirm');
        }

        //$order = null;

        try {

            DB::transaction(function () {

                //dd($order);

                $cartItems = Cart::with('item')->where('user_id', Auth::id())->get();

                $order = Order::create([

                    'user_id' => Auth::id()
                ]);

                //dd($order);

                foreach ($cartItems as $cartItem) {

                    OrderDetail::create([

                        'order_id' => $order->id,
                        'item_id' => $cartItem->item->id,
                        'item_num' => $cartItem->item_num
                    ]);
                }

                Cart::where('user_id', Auth::id())->delete();

            }, 5);
        } catch (\Exception $e) {

            Log::error('購入処理中のエラー' . $e);
            return redirect()->route('errors.error');
        }

        // dd($order);

        return redirect()->route('order.thank_you');
    }

    public function thankYou()
    {
        $orders = Order::with('order_details.item')->where('user_id', Auth::id())->first();
        return view('order.thank_you', compact('orders'));
    }
}
