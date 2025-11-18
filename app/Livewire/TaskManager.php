<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class TaskManager extends Component
{
    use WithFileUploads;

    /** @var Collection<int, Task> */
    public Collection $tasks;

    public string $title;

    public string $body;

    public string $date;

    public int $author_id;

    public string $status;

    public ?TemporaryUploadedFile $file = null;

    /** @var array<string, string> */
    protected array $rules = [
        'title' => 'required|string|max:255',
        'date' => 'required|date',
        'author_id' => 'required|in:1,2,3',
        'status' => 'required|in:pending,completed',
        'body' => 'required|string',
        'file' => 'nullable|file|max:1024',
    ];

    public function createTask(): void
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'body' => $this->body,
            'status' => $this->status,
            'date' => $this->date,
            'author_id' => $this->author_id,
        ];

        if ($this->file) {
            $path = $this->file->store('files');
            $data['file'] = $path;
        }

        Task::create($data);

        $this->resetFields();

        $this->loadTasks();

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

    #[On('delete-task')]
    public function deleteTask(Task $task): void
    {
        $task->delete();

        $this->loadTasks();

        // @phpstan-ignore-next-line
        Flux::modals()->close();
    }

    /**
     * @param  array<string, mixed>  $data
     */
    #[On('update-task')]
    public function updateTask(array $data, Task $task): void
    {
        /** @var array<string, mixed> $data */
        $task->update($data);

        $this->dispatch('refresh-size', $task);

        $this->loadTasks();

        // @phpstan-ignore-next-line
        Flux::modals()->close();
    }

    public function loadTasks(): void
    {
        $this->tasks = Task::all();
    }

    public function render(): View
    {
        if (empty($this->tasks)) {
            $this->loadTasks();
        }

        return view('livewire.task-manager');
    }
}
