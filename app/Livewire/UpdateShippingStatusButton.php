<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UpdateShippingStatusButton extends Component
{

    public $saleHistory;

    public function update($saleHistory)
    {
        $order = Order::where('id', $saleHistory)->first();

        if($order->id === 0){
            $order->update(['id' => 1]);
        } elseif($order->id === 1){
            $order->update(['id' => 0]);
        } else{
            //カラムの値がもし1、0以外のとき何も行わない
        }
    }

    public function render()
    {

        return view('livewire.UpdateShippingStatusButton');
    }
}
