<?php

namespace App\Livewire\Components;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Card extends Component
{
    use WithFileUploads;

    public Task $task;

    public int $id;

    public string $title;

    public string $body;

    public int $author_id;

    public string $date;

    public string $status;

    public string $size;

    public ?TemporaryUploadedFile $file = null;

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
        $this->status = $task->status;
        $this->size = $this->sizeFile($task);
    }

    /** @var array<string, string> */
    protected array $rules = [
        'title' => 'nullable|string|max:255',
        'date' => 'nullable|date',
        'status' => 'required|in:pending,completed',
        'author_id' => 'nullable|in:1,2,3',
        'body' => 'nullable|string',
        'file' => 'nullable|file|max:1024',
    ];

    public function updateTask(Task $task): void
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'body' => $this->body,
            'date' => $this->date,
            'status' => $this->status,
            'author_id' => $this->author_id,
        ];

        if ($this->file) {
            if ($task->file) {
                Storage::delete($task->file);
            }
            $path = $this->file->store('files');
            $data['file'] = $path;
        }

        $this->dispatch('update-task', data: $data, task: $task);
    }

    public function deleteTask(Task $task): void
    {
        $this->dispatch('delete-task', task: $task);
    }

    public function sizeFile(Task $task): string
    {
        $sizeFormatted = '';
        if ($task->file) {
            $size = Storage::size($task->file);
            $sizeFormatted = 'KB '.number_format($size / 1024, 2);
        }

        return $sizeFormatted;
    }

    #[On('refresh-size')]
    public function refreshSize(Task $task): void
    {
        $this->size = $this->sizeFile($task);
    }

    public function render(): View
    {
        return view('livewire.Components.card');
    }
}
