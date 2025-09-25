<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UpdateShippingStatusButton extends Component
{

    public $saleHistoryId;
    public $isSipped;

    public function update($saleHistoryId)
    {
        $order = Order::where('id', $saleHistoryId)->first();

        if($order->is_shipped === 0){
            $order->update(['is_shipped' => 1]);
        } elseif($order->is_shipped === 1){
            $order->update(['is_shipped' => 0]);
        } else{
            //カラムの値がもし1、0以外のとき何も行わない
        }
    }

    public function render()
    {

        return view('livewire.UpdateShippingStatusButton');
    }
}
