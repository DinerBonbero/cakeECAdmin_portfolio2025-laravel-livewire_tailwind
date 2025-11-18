<?php

namespace App\Livewire;

use Livewire\Component;

class CartItemQuantityAlert extends Component
{
    public $cartItem;

    public function render()
    {
        
        return view('livewire.cart-item-quantity-alert');
    }
}
