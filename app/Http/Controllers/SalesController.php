<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function history(Request $request)
    {

        if ($request->hasAny(['un_shipped', 'shipped', 'start_date', 'end_date', 'purchaser_name'])) {
            //入力値が一つでもある場合

            $purchaserName = $request->input('purchaser_name');
            //購入者名の入力値を取得

            $validatedSearchInputs = $request->validate([
                'un_shipped' => Rule::in('0'),
                'shipped' => Rule::in('1'),
                'start_date' =>  [Rule::date()->format('Y-m-d'), 'nullable'],
                'end_date' => [Rule::date()->format('Y-m-d'), 'nullable']
            ], [
                'un_shipped.in' => 'この値は無効です、選択肢から選んでください。',
                'shipped.in' => 'この値は無効です、選択肢から選んでください。',
                'start_date.date_format' => '開始日は半角数字YYYY-MM-DD形式で入力してください。',
                'end_date.date_format' => '終了日は半角数字YYYY-MM-DD形式で入力してください。'
            ]);

            $query = Order::query();
            //Orderモデルのクエリビルダを取得

            if (isset($validatedSearchInputs['un_shipped']) && isset($validatedSearchInputs['shipped'])) {
                //両方のチェックボックスにチェックが入っている場合
                //※チェックボックスはチェックがなければname自体が送信されないため、issetで判定

                $query->where(function ($query) use ($validatedSearchInputs) {
                    //NOT,AND,ORの組み合わせで条件をつける場合、whereのクロージャーを使用してグループ化する
                    //where(function () {})を使用することでsqlの()の意味を持ち()を優先する

                    $query->where('is_shipped', $validatedSearchInputs['un_shipped'])->orWhere('is_shipped', $validatedSearchInputs['shipped']);
                    //where(function () use() {}はwhereのクロージャーで記載するときは必ずfunction ()の引数は一つでクエリを渡す前提、
                    //なのでuse($validatedSearchInputs)を使用して固定の引数とは別に分けて引数を渡す。
                    //クロージャはsqlの()の意味をもち()を優先してくれる。
                });
            } elseif (isset($validatedSearchInputs['un_shipped'])) {
                //発送未済みにチェックが入っている場合

                $query->where('is_shipped', $validatedSearchInputs['un_shipped']);
                //is_shippedが0(未発送)の注文情報を取得
            } elseif (isset($validatedSearchInputs['shipped'])) {
                //発送済みにチェックが入っている場合

                $query->where('is_shipped', $validatedSearchInputs['shipped']);
                //is_shippedが1(発送済み)の注文情報を取得
            } else {
                //どちらのチェックボックスにもチェックが入っていない場合、処理なし

            }

            if (isset($validatedSearchInputs['start_date'])) {
                //開始日の入力値がある場合

                $query->whereDate('date', '>=', $validatedSearchInputs['start_date']);
                //dateカラムの日付が開始日以降の注文情報を取得、whereDateは日時型カラムから日付部分のみを比較するメソッド
                //whereだと日時まで比較してしまうため、開始日の日付の00:00:00以降しか取得できなくなる、結果が狂ってしまう
            }

            if (isset($validatedSearchInputs['end_date'])) {
                //終了日の入力値がある場合

                $query->whereDate('date', '<=', $validatedSearchInputs['end_date']);
                //dateカラムの日付が終了日以前の注文情報を取得
            }

            if (isset($purchaserName)) {
                //購入者名の入力値がある場合

                $query->join('users', 'orders.user_id', '=', 'users.id')
                    ->join('user_infos', 'users.id', '=', 'user_infos.user_id');
                    //joinはクロージャのに含めない！(ジョイン句、and,or)はあり得ない構造。クロージャに入れてしまうことでjoinが無効化してしまう

                $query->where(function ($query) use ($purchaserName) {
                    //NOT,AND,ORの組み合わせで条件をつける場合、whereのクロージャーを使用してグループ化する


                    $query->where('user_infos.last_name', 'like', "%{$purchaserName}%")
                        ->orWhere('user_infos.first_name', 'like', "%{$purchaserName}%")
                        ->orwhere(DB::raw("CONCAT(user_infos.last_name, user_infos.first_name)"), 'like', '%' . $purchaserName . '%')
                        ->orwhere(DB::raw("CONCAT(user_infos.last_name, '　', user_infos.first_name)"), 'like', '%' . $purchaserName . '%')
                        ->orwhere(DB::raw("CONCAT(user_infos.last_name, ' ', user_infos.first_name)"), 'like', '%' . $purchaserName . '%');
                    //user_infoテーブルのlast_nameカラムまたはfirst_nameカラムに購入者名の入力値が部分一致または姓と名に部分一致する注文情報を取得
                    //すでにjoin()を記載しているためwhereRelation,orWhereRelationは不必要、joinが二重になる
                    //with()はSQLでInのため合致するレコードの参照！つまりsqlでjoinしているわけではないのでテーブルが結合していない
                    //テーブルの結合が必要な素のSQL文などのときは必ずwithではなくjoinを記述する
                    //※このときwhereの引数に記載するリレーション先の結合したカラムの取得の仕方がwithと変わるのでよく意味を考えて記述する
                    //例：テーブルのカラム(user_infos.last_name)などの構造やテーブル名、カラム名
                });
            }

            $saleHistories = $query->with('order_details.item')->with(['user' => function ($query) {
                $query->select('id');
            }, 'user.user_info'])->latest('date')->paginate(3);
            //条件で絞った注文情報とリレーション先のレコードを取得、userテーブルはパスワードなどは取得せずidのみ取得
            //リレーション先：order_detailsとitem、userのidとuser_info

            //->withQueryString()検索結果のがペジネーションに反映されるように->withQueryString()
            //または->appends($request->all())を使用、今回はビューで処理しているため不要

            return  view('sales.history', compact('saleHistories', 'validatedSearchInputs', 'purchaserName'));
            //検索結果ページ表示(元の販売履歴ページ)かつ検索条件で絞られた注文情報と保持用の検索した入力値を渡す
        } else {
            //入力値が一つもない場合、通常の販売履歴表示

            $saleHistories = Order::with('order_details.item')->with(['user' => function ($query) {
                $query->select('id');
            }, 'user.user_info'])->latest('date')->paginate(3);
            //注文情報とリレーション先のレコードを取得、userテーブルはパスワードなどは取得せずidのみ取得
            //リレーション先：order_detailsとitemテーブル、userのidとuser_infoテーブルも取得

            return  view('sales.history', compact('saleHistories'));
        }
    }
}
