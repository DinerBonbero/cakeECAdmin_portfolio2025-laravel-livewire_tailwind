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
use Exception;

class OrderController extends Controller
{
    public function confirm()
    {
        
        $cartItems = Cart::with('item')->whereRelation('item', 'is_pending', 0)->where('user_id', Auth::id())->latest('id')->get(); // テーブルが複数か単数か気を付ける
        // latest「最新の」

        $userInfo = UserInfo::where('user_id', Auth::id())->first();
        $mail = User::where('id', Auth::id())->value('email');

        return view('order.confirm', compact('cartItems', 'userInfo', 'mail'));
        // 注文確認画面表示かつカート情報、ユーザー情報、メールアドレスを渡す
    }

    public function store()
    {
        $userInfo = UserInfo::where('user_id', Auth::id())->first();

        if (!$userInfo) {

            return redirect()->route('order.confirm');
            //ユーザー情報が未登録の場合、注文確認画面へリダイレクト
        }

        try {

            DB::transaction(function () {

                // throw new Exception;
                //例外を拾うかテスト用

                $cartItems = Cart::with('item')->where('user_id', Auth::id())->get();
                //ログインユーザーのカート情報を取得

                $order = Order::create([

                    'user_id' => Auth::id()
                ]);
                //注文情報を登録

                foreach ($cartItems as $cartItem) {

                    //カート情報分繰り返して注文詳細情報を登録 ※カートのレコード分と注文詳細のレコード分の数は等しい

                    OrderDetail::create([

                        'order_id' => $order->id, //登録した注文のid
                        'item_id' => $cartItem->item->id, //カートに入っている商品のid
                        'item_num' => $cartItem->item_num //カートに入っている商品の個数
                        //↑これらを注文詳細テーブルに登録
                    ]);
                }

                Cart::where('user_id', Auth::id())->delete();
                //注文情報登録後、カート情報を削除
            }, 5);
        } catch (\Exception $e) {

            Log::error('購入処理中に例外発生' . $e->getMessage());
            return redirect()->route('errors.error');
            //エラーが発生した場合はログにエラー内容を記録し、エラー表示画面へリダイレクト
        }

        return redirect()->route('order.thank_you');
    }

    public function thankYou()
    {

        $orders = Order::with('orderDetails.item')->where('user_id', Auth::id())->latest('date')->first();
        //直近のログインユーザーの注文情報一件を取得
        return view('order.thank_you', compact('orders'));
        //サンクスページ表示かつ注文情報を渡す
    }

    public function history()
    {

        $orderHistories = Order::with('orderDetails.item')->where('user_id', Auth::id())->latest('date')->paginate(3);
        //ログインユーザーの注文情報を新しい日付順に1ページ3件ずつペジネーション表示で取得

        return  view('order.history', compact('orderHistories'));
        //注文履歴ページ表示かつ注文情報を渡す
    }
}
