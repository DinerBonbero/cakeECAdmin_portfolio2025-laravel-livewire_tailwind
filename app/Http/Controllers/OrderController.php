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
        
        $cartItems = Auth::user()->carts()->with('item')->whereRelation('item', 'is_pending', 0)->latest('id')->get();
        // テーブルが複数か単数か気を付ける
        // $cartItems = Cart::with('item')->whereRelation('item', 'is_pending', 0)->where('user_id', Auth::id())->latest('id')->get(); // テーブルが複数か単数か気を付ける
        // latest「最新の」

        $userInfo = Auth::user()->userInfo()->first();
        // $userInfo = UserInfo::where('user_id', Auth::id())->first();
        
        $mail = User::where('id', Auth::id())->value('email');
        // $mail = Auth::user()->value('email');では他者のメールが取れてしまう。
        // Auth::user()の @return \Illuminate\Contracts\Auth\Authenticatable|nullと@return \App\Models\User|nullの返り値と
        // value()のIlluminate\Database\Eloquent\Builder::valueとApp\Models\User::valueに合致している表記だが、おそらくApp\Models\User::valueはvscode側の推測ミス

        return view('order.confirm', compact('cartItems', 'userInfo', 'mail'));
        // 注文確認画面表示かつカート情報、ユーザー情報、メールアドレスを渡す
    }

    public function store()
    {
        $userInfo = Auth::user()->userInfo()->first();
        // $userInfo = UserInfo::where('user_id', Auth::id())->first();

        if (!$userInfo) {

            return redirect()->route('order.confirm');
            //ユーザー情報が未登録の場合、注文確認画面へリダイレクト
        }

        try {

            DB::transaction(function () {

                // throw new Exception;
                //例外を拾うかテスト用

                $cartItems = Auth::user()->carts()->with('item')->get();
                // $cartItems = Cart::with('item')->where('user_id', Auth::id())->get();
                //ログインユーザーのカート情報を取得

                $order = Auth::user()->orders()->create();
                // 自動で認証ユーザーのidとリレーション先の注文レコードのカラムuser_idを作成　※カラムをcreateに明示して記述する必要なし
                // 注文情報を登録

                // $order = Order::create([

                //     'user_id' => Auth::id()
                // ]);
                

                foreach ($cartItems as $cartItem) {

                    //カート情報分繰り返して注文詳細情報を登録 ※カートのレコード分と注文詳細のレコード分の数は等しい

                    OrderDetail::create([

                        'order_id' => $order->id, //登録した注文のid
                        'item_id' => $cartItem->item->id, //カートに入っている商品のid
                        'item_num' => $cartItem->item_num //カートに入っている商品の個数
                        //↑これらを注文詳細テーブルに登録
                    ]);
                }

                Auth::user()->carts()->delete();
                // Cart::where('user_id', Auth::id())->delete();
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

        $orders = Auth::user()->orders()->with('orderDetails.item')->latest('date')->first();
        //直近のログインユーザーの注文情報一件を取得
        return view('order.thank_you', compact('orders'));
        //サンクスページ表示かつ注文情報を渡す
    }

    public function history()
    {

        $orderHistories = Auth::user()->orders()->with('orderDetails.item')->latest('date')->paginate(3);
        //ログインユーザーの注文情報を新しい日付順に1ページ3件ずつペジネーション表示で取得

        return  view('order.history', compact('orderHistories'));
        //注文履歴ページ表示かつ注文情報を渡す
    }
}
