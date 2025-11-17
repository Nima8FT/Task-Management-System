<?php

namespace App\Livewire\Components;

use App\Models\Task;
use Carbon\Carbon;
use Flux\Flux;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class Card extends Component
{
    public Task $task;

    public int $id;

    public string $title;

    public string $body;

    public int $author_id;

    public string $date;

    public string $status;

    public string $file;

    /**
     * Create a new component instance.
     */
    public function mount(Task $task): void
    {
        $this->task = $task;
        $this->id = $task->id;
        $this->title = Str::limit($task->title, 20, '...');
        $this->body = Str::limit($task->body, 250, '...');
        $this->author_id = $task->author_id;
        $this->date = Carbon::parse($task->date)->format('Y-m-d');
        $this->status = $task->status === 'completed' ? 'from-green-500 to-green-700' : 'from-red-700 to-red-900';
    }

    /** @var array<string, string> */
    protected array $rules = [
        'title' => 'nullable|string|max:255',
        'date' => 'nullable|date',
        'author_id' => 'nullable|in:1,2,3',
        'body' => 'nullable|string',
        'file' => 'nullable|file|max:1024',
    ];

    public function updateTask(Task $task): RedirectResponse
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'body' => $this->body,
            'date' => $this->date,
            'author_id' => $this->author_id,
        ];

        if (! empty($this->file)) {
            $data['file'] = $this->file;
        }

        $task->update($data);

        $this->resetFields();

        // @phpstan-ignore-next-line
        Flux::modals()->close();

        return redirect()->route('tasks');
    }

    public function deleteTask(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks');
    }

    public function resetFields(): void
    {
        $this->title = '';
        $this->body = '';
        $this->date = '';
        $this->author_id = 0;
    }

    public function render(): View
    {
        return view('livewire.Components.card');
    }
}
