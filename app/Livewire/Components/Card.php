<?php

namespace App\Livewire\Components;

use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Morilog\Jalali\Jalalian;

class Card extends Component
{
    public Task $task;

    public string $title;

    public string $body;

    public string $date;

    public string $status;

    /**
     * Create a new component instance.
     */
    public function mount(Task $task): void
    {
        $this->task = $task;
        $this->title = Str::limit($task->title, 20, '...');
        $this->body = Str::limit($task->body, 250, '...');
        $this->date = Jalalian::fromDateTime($task->date)->format('Y/m/d');
        $this->status = $task->status === 'completed' ? 'from-green-500 to-green-700' : 'from-red-700 to-red-900';
    }

    public function render(): View
    {
        return view('livewire.Components.card');
    }
}
