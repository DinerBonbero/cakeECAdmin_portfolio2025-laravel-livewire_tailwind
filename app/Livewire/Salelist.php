<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class Salelist extends Component
{

    public $saleHistory;
    public $total;
    public $orderDetailNum;

    // public function mount()
    // {
    //     $this->todos = Auth::user()->todos;
    // }

    public function update()
    {
        $order = Order::where('id', $this->saleHistory->id)->first();

        // dd($order);
        // exit();

        if($order->is_shipped === 0){
            $order->update(['is_shipped' => 1]);
            $this->saleHistory->is_shipped = 1;
        } elseif($order->is_shipped === 1){
            $order->update(['is_shipped' => 0]);
            $this->saleHistory->is_shipped = 0;
        } else{
            //カラムの値がもし1、0以外のとき何も行わない
        }

    }

    public function render()
    {

        return view('livewire.Salelist');
    }
}
