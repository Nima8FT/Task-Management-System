<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Integer;

class TaskManager extends Component
{
    /**
     * @var Collection<int, Task>
     */
    public Collection $tasks;

    public string $title;

    public string $body;

    public Integer $author_id;

    public string $date;

    public string $status;

    public string $file;

    public function mount(): void
    {
        $this->tasks = Task::all();
    }

    public function render(): View
    {
        return view('livewire.task-manager');
    }
}
