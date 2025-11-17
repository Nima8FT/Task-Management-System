<?php

namespace App\Livewire\Layouts;

use Illuminate\View\View;
use Livewire\Component;

class TopHeader extends Component
{
    public string $search = '';

    public function updatedSearch(): void
    {
        $this->dispatch('filter-by-search', search: $this->search);
    }

    public function render(): View
    {
        return view('livewire.layouts.top-header');
    }
}
