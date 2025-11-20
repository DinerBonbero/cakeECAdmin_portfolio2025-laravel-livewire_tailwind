<?php

namespace App\Livewire;

use Livewire\Component;

class CartItemQuantityAlert extends Component
{
    public $cartItem;
    public $cartItemNum;
    public $isUpdate;

    public function mount(){
        
        $this->isUpdate = null;

        $this->cartItemNum = $this->cartItem->item_num;

        return view('livewire.cart-item-quantity-alert');
    }

    public function updatedCartItemNum(){
        //wire:model+プロパティ名をinputに指定して関数にupdated+プロパティと命名すると自動で発火する

        if($this->cartItemNum == $this->cartItem->item_num){
            //$this->cartItemNumは文字列、$this->cartItem->item_numはintのため==で型は無視
            
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
