<?php

namespace App\Livewire\Layouts;

use Illuminate\View\View;
use Livewire\Component;

class DownHeader extends Component
{
    public function findByUser(int $id): void
    {
        $this->dispatch('filter-by-user', id: $id);
    }

    public function render(): View
    {
        return view('livewire.layouts.down-header');
    }
}
