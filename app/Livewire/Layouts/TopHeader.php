<?php

namespace App\Livewire\Layouts;

use Illuminate\View\View;
use Livewire\Component;

class TopHeader extends Component
{
    public function render(): View
    {
        return view('livewire.layouts.top-header');
    }
}
