<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class SalesController extends Controller
{
    public function history(Request $request)
    {
        // dd($request);
        // exit();

        // un_shipped 検索のname
        // shipped
        // start_date
        // end_date
        // purchaser_name

        if ($request->hasAny(['un_shipped', 'shipped', 'start_date', 'end_date', 'purchaser_name'])) {
            //★バリデーション記述必要！！！！

            $query = Order::query();

            if ('0' === $request->input('un_shipped')) {
                $query->where('is_shipped', $request->un_shipped);
            }

            if (!empty($request->input('shipped'))) {
                $query->where('is_shipped', $request->shipped);
            }

            if (!empty($request->input('start_date'))) {
                $query->where('date', '>=', $request->start_date);
            }

            if (!empty($request->input('end_date'))) {
                $query->where('date', '<=', $request->end_date);
            }

            if (!empty($request->input('purchaser_name'))) {
                $query->where('user_info.last_name', 'like', "%{$request->purchaser_name}%")
                    ->Where('user_info.first_name', 'like', "%{$request->purchaser_name}%");
            }

            $saleHistories = $query->with('order_details.item')->with(['user' => function ($query) {
                $query->select('id');
            }, 'user.user_info'])->latest('date')->paginate(3);

            return  view('sales.history', compact('saleHistories'));
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
