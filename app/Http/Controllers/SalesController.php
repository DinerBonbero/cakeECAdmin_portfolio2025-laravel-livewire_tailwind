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

        if ($request->session()->exists(['un_shipped', 'shipped', 'start_date', 'end_date', 'purchaser_name'])) {
            $request->session()->forget(['un_shipped', 'shipped', 'start_date', 'end_date', 'purchaser_name']);
        }
        // dd($request);
        // exit();

        if ($request->hasAny(['un_shipped', 'shipped', 'start_date', 'end_date', 'purchaser_name'])) {

            $validated = $request->validate([
                'un_shipped' => Rule::in('0'),
                'shipped' => Rule::in('1'),
                'start_date' =>  [Rule::date()->format('Y-m-d'), 'nullable'],
                'end_date' => [Rule::date()->format('Y-m-d'), 'nullable'],
                'purchaser_name' => 'max:30'
            ], [
                'un_shipped.in' => 'この値は無効です、選択肢から選んでください。',
                'shipped.in' => 'この値は無効です、選択肢から選んでください。',
                'start_date.date_format' => '開始日は半角数字YYYY-MM-DD形式で入力してください。',
                'end_date.date_format' => '終了日は半角数字YYYY-MM-DD形式で入力してください。',
                'purchaser_name.max' => '入力文字は30文字以上で入力してください。',
            ]);

            // dd($validated);
            // exit();

            $query = Order::query();

            if (isset($validated['un_shipped']) && isset($validated['shipped'])) {

                $query->where('is_shipped', $validated['un_shipped'])
                    ->orWhere('is_shipped', $validated['shipped']);

                $request->session()->put('un_shipped', $validated['un_shipped']);
                $request->session()->put('shipped', $validated['shipped']);
            } elseif (isset($validated['un_shipped'])) {

                $query->where('is_shipped', $validated['un_shipped']);

                $request->session()->put('un_shipped', $validated['un_shipped']);
            } elseif (isset($validated['shipped'])) {

                $query->where('is_shipped', $validated['shipped']);

                $request->session()->put('shipped', $validated['shipped']);
            } else {
            }

            if (isset($validated['start_date'])) {

                $query->whereDate('date', '>=', $validated['start_date']);

                $request->session()->put('start_date', $validated['start_date']);
            }

            if (isset($validated['end_date'])) {

                $query->whereDate('date', '<=', $validated['end_date']);

                $request->session()->put('end_date', $validated['end_date']);
            }

            if (isset($validated['purchaser_name'])) {
                $query->whereRelation('user.user_info', 'last_name', 'like', "%{$validated['purchaser_name']}%")
                    ->orWhereRelation('user.user_info', 'first_name', 'like', "%{$validated['purchaser_name']}%");

                // $query->where(DB::raw('CONCAT(user.user_info.last_name, user.user_info.first_name)'), 'like', "%{$request->purchaser_name}%");

                $request->session()->put('purchaser_name', $validated['purchaser_name']);
            }

            $saleHistories = $query->with('order_details.item')->with(['user' => function ($query) {
                $query->select('id');
            }, 'user.user_info'])->latest('date')->paginate(3); //->withQueryString()検索結果のがペジネーションに反映されるように->withQueryString()

            return  view('sales.history', compact('saleHistories', ));
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
