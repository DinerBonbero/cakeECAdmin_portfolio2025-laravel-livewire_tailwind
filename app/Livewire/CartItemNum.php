<?php

namespace App\Livewire;

use Livewire\Component;

class CartItemNum extends Component
{
    public $cartItem;

    public function update($cartItem)
    {
        $this->$cartItem++;
        $this->$cartItem--;
    }

    public function render()
    {

        return view('livewire.CartItemNum');
    }
}
