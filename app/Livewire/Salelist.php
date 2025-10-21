<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class Salelist extends Component
{

    public $saleHistory;
    public $total;
    public $orderDetailNum;

    public function update()
    {
        $order = Order::where('id', $this->saleHistory->id)->first();

        if ($order->is_shipped === 0) {
            //未発送の場合

            $order->update(['is_shipped' => 1]);
            //発送済みに更新

            $this->saleHistory->is_shipped = 1;
            //Livewire側のプロパティも更新
        } elseif ($order->is_shipped === 1) {
            //発送済みの場合

            $order->update(['is_shipped' => 0]);
            //未発送に更新

            $this->saleHistory->is_shipped = 0;
            //Livewire側のプロパティも更新
        } else {
            //まず状況的にあり得ないがカラムの値がもし1、0以外のとき何も行わない
            
        }
    }

    public function render()
    {

        return view('livewire.Salelist');
    }
}
