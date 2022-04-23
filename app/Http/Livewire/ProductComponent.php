<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductComponent extends Component
{
    public $product;
    public function mount($product){
        $this->product = $product ;
    }

    public function addToCart($product_id,$product_name, $product_price){
        dd("ok");
        Cart::add($product_id,$product_name, 1, $product_price)->associate("App\models\Product");
        session()->flash('success_message', "Produit ajouté au panier !");
        return redirect()->route('home');
    }
    public function render()
    {
        return view('livewire.product-component');
    }
}
