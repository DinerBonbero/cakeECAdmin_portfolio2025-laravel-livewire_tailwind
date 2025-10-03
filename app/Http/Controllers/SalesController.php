<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use App\Models\UserInfo;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
class SalesController extends Controller
{
    public function history(Request $request)
    {

        // if ($request->session()->exists(['un_shipped', 'shipped', 'start_date', 'end_date', 'purchaser_name'])) {
        //     $request->session()->forget(['un_shipped', 'shipped', 'start_date', 'end_date', 'purchaser_name']);
        // }
        // dd($request);
        // exit();

        if ($request->hasAny(['un_shipped', 'shipped', 'start_date', 'end_date', 'purchaser_name'])) {
            // dd($request);
            // exit();
            $purchaserName = $request->input('purchaser_name');

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

            // dd($validatedSearchInputs);
            // exit();

            $query = Order::query();

            if (isset($validatedSearchInputs['un_shipped']) && isset($validatedSearchInputs['shipped'])) {

                $query->where(function ($query) use($validatedSearchInputs) {
                    $query->where('is_shipped', $validatedSearchInputs['un_shipped'])->orWhere('is_shipped', $validatedSearchInputs['shipped']);
                    //where(function () use() {}はwhereのクロージャーで記載するときは必ずfunction ()の引数は一つでクエリを渡す前提、
                    //なのでuse($validatedSearchInputs)を使用して固定の引数とは別に分けて引数を渡す。
                });
            } elseif (isset($validatedSearchInputs['un_shipped'])) {

                $query->where('is_shipped', $validatedSearchInputs['un_shipped']);
            } elseif (isset($validatedSearchInputs['shipped'])) {

                $query->where('is_shipped', $validatedSearchInputs['shipped']);
            } else {
            }

            if (isset($validatedSearchInputs['start_date'])) {

                $query->whereDate('date', '>=', $validatedSearchInputs['start_date']);
            }

            if (isset($validatedSearchInputs['end_date'])) {

                $query->whereDate('date', '<=', $validatedSearchInputs['end_date']);
            }

            if (isset($purchaserName)) {
                $query->whereRelation('user.user_info', 'last_name', 'like', "%{$purchaserName}%")
                    ->orWhereRelation('user.user_info', 'first_name', 'like', "%{$purchaserName}%");
            }

            $purchaserName = $request->input('purchaser_name');

            $saleHistories = $query->with('order_details.item')->with(['user' => function ($query) {
                $query->select('id');
            }, 'user.user_info'])->latest('date')->paginate(3); //->withQueryString()検索結果のがペジネーションに反映されるように->withQueryString()

            return  view('sales.history', compact('saleHistories', 'validatedSearchInputs', 'purchaserName'));
        } else {

            $saleHistories = Order::with('order_details.item')->with(['user' => function ($query) {
                $query->select('id');
            }, 'user.user_info'])->latest('date')->paginate(3);

            // dd($saleHistories);
            // exit();
            return  view('sales.history', compact('saleHistories'));
        }
    }
}
