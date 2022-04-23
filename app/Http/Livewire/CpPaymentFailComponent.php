<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CpPaymentFailComponent extends Component
{
    public function render()
    {
        return view('livewire.cp-payment-fail-component')->layout("layouts.base");
    }
}
