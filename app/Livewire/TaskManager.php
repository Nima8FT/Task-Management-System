<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class TaskManager extends Component
{
    use WithFileUploads;

    /** @var Collection<int, Task> */
    public Collection $tasks;

    #[Validate('nullable|file|max:1024')]
    public ?TemporaryUploadedFile $file = null;

    /**
     * @param  array<string, mixed>  $data
     */
    #[On('create-task')]
    public function createTask(array $data): void
    {
        Task::create($data);

        $this->loadTasks();

        // @phpstan-ignore-next-line
        Flux::modals()->close();
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

        if ($task->file) {
            Storage::delete($task->file);
        }

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
