<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartItemNum extends Component
{

    // public $cartItem;

    // public function update($CartId, $delta)
    // {
    //     if ($delta == '+') {

    //         $cart = Cart::where('user_id', Auth::id())->where('id', $CartId)->first();
    //         dd($cart);
    //         exit();

    //         $cart->update([
    //             'item_num' => $cart->item_num + 1,
    //         ]);

    //     } elseif ($delta == '-') {

    //         $cart = Cart::where('user_id', Auth::id())->where('id', $CartId)->first();
    //         dd($cart);
    //         exit();

    //         $cart->update([
    //             'item_num' => $cart->item_num - 1,
    //         ]);
    //      }


    // }

    public function render()
    {

        return view('livewire.CartItemNum');
    }
}
