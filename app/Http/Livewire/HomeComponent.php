<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class HomeComponent extends Component
{
    use WithPagination ;
    public function render()
    {
        $products = Product::paginate(8);
        return view('livewire.home-component', compact('products'))->layout('layouts.base');
    }
}
