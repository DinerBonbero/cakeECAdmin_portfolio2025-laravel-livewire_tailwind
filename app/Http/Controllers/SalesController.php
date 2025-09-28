<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function history(Request $request)
    {
        dd($request);
        exit();

        // un_shipped 検索のname
        // shipped
        // start_date
        // end_date
        // purchaser_name

        // if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行します
        //     $companies->where('company_name', 'LIKE', "%{$keyword}%")
        //     ->orwhereHas('products', function ($query) use ($keyword) {
        //         $query->where('product_name', 'LIKE', "%{$keyword}%");
        //     })->get();

        // }

        $saleHistories = Order::with('order_details.item')->with(['user' => function ($query) {
            $query->select('id');
        }, 'user.user_info'])->latest('date')->paginate(3);

        // dd($saleHistories);
        // exit();
        return  view('sales.history', compact('saleHistories'));
    }
}
