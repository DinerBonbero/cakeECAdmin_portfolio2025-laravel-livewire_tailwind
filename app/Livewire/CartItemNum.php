<?php

namespace App\Livewire;

use Livewire\Component;

class CartItemNum extends Component
{
    public function render()
    {
        return view('mycart.index');
    }

        public function increment($count)
    {
        $this->$count++;
    }
 
    public function decrement($count)
    {
        $this->$count--;
    }
}
