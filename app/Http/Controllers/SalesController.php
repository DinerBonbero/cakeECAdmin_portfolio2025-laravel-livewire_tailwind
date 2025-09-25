<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function history()
    {

        $saleHistories = Order::with('order_details.item')->with(['user' => function ($query) {
            $query->select('id');
        }, 'user.user_info'])->latest('date')->paginate(3);

        // dd($saleHistories);
        // exit();
        return  view('sales.history', compact('saleHistories'));
    }
}
