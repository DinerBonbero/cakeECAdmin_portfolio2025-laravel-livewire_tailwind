<?php

namespace App\Livewire;

use Livewire\Component;

class CartItemQuantityAlert extends Component
{
    public $cartItem;
    public $cartItemNum;
    public $isUpdate = null;

    public function mount(){

        $this->cartItemNum = $this->cartItem->item_num;

        return view('livewire.cart-item-quantity-alert');
    }

    public function updatedCartItemNum(){
        //wire:model+プロパティ名をinputに指定して関数にupdated+プロパティにすると自動で発火する

        if($this->cartItemNum === $this->cartItem->item_num){

            $this->isUpdate = 'true';
        }else{

            $this->isUpdate = 'false';
        }
    }

    public function render()
    {
        
        return view('livewire.cart-item-quantity-alert');
    }
}
