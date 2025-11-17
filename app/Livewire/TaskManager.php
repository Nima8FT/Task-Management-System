<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskManager extends Component
{
    /** @var Collection<int, Task> */
    public Collection $tasks;

    public string $title;

    public string $body;

    public string $date;

    public int $author_id;

    public string $file;

    /** @var array<string, string> */
    protected array $rules = [
        'title' => 'required|string|max:255',
        'date' => 'required|date',
        'author_id' => 'required|in:1,2,3',
        'body' => 'required|string',
        'file' => 'nullable|file|max:1024',
    ];

    public function createTask(): void
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

        Task::create($data);

        $this->resetFields();

        // @phpstan-ignore-next-line
        Flux::modals()->close();
    }

    public function resetFields(): void
    {
        $this->title = '';
        $this->body = '';
        $this->date = '';
        $this->author_id = 0;
    }

    #[On('filter-by-user')]
    public function filterByUser(int $id): void
    {
        $user = User::find($id);
        // @phpstan-ignore-next-line
        $this->tasks = $user ? $user->tasks()->get() : collect();
    }

    #[On('filter-by-status')]
    public function handleFilter(string $filter): void
    {
        if ($filter === 'all') {
            $this->tasks = Task::all();
        } else {
            $this->tasks = Task::where('status', $filter)->get();
        }
    }

    #[On('filter-by-search')]
    public function filterBySearch(string $search): void
    {
        $this->tasks = Task::query()->where('title', 'LIKE', '%'.$search.'%')->get();
    }

    public function render(): View
    {
        if (empty($this->tasks)) {
            $this->tasks = Task::all();
        }

        return view('livewire.task-manager');
    }
}
