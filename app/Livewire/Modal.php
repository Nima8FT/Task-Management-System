<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\View\View;

class Modal extends Component
{
    public function render(): View
    {
        return view('livewire.modal');
    }
}
