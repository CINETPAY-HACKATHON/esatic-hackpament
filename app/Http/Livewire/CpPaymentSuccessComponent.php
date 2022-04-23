<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CpPaymentSuccessComponent extends Component
{
    public function render()
    {
        return view('livewire.cp-payment-success-component')->layout('layouts.base');
    }
}
