<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class TaskManager extends Component
{
    /**
     * @var Collection<int, Task>
     */
    public Collection $tasks;

    public function mount(): void
    {
        $this->tasks = Task::all();
    }

    public function render(): View
    {
        return view('livewire.task-manager');
    }
}
