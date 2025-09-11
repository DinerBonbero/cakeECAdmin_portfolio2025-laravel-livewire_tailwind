<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;

class CartItemNum extends Component
{
    public $count = 0;

    public function update($count)
    {
        $this->$count++;
        $this->$count--;
    }

    public function render()
    {
        return view('livewire.increment');
        return view('livewire.decrement');
    }
}
