<?php

namespace App\Livewire\Components;

use Flux\Flux;
use Carbon\Carbon;
use App\Models\Task;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Modal extends Component
{
    use WithFileUploads;

    public string $mode = 'create';

    public ?Task $task = null;

    public int $taskId = 0;

    #[Validate('required|string|max:255')]
    public string $title;

    #[Validate('required|string')]
    public string $body;

    #[Validate('required|date')]
    public string $date;

    #[Validate('required|in:1,2,3')]
    public int $author_id;

    #[Validate('required|in:pending,completed')]
    public string $status;

    #[Validate('nullable|file|max:1024')]
    public ?TemporaryUploadedFile $file = null;

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'title.unique' => 'این عنوان قبلاً استفاده شده است.',
            'title.required' => 'لطفاً عنوان را وارد کنید.',
            'body.required' => 'لطفا توضیحات را وارد کنید.',
            'date.required' => 'لطفا تاریخ را وارد کنید.',
            'author_id.required' => 'لطفا کاربر را انتخاب کنید.',
            'status.required' => 'لطفا وضعیت را انتخاب کنید.',
            'validation.in' => 'لطفا کاربر را انتخاب کنید.',
        ];
    }

    #[On('open-modal-create')]
    public function createTask(): void
    {
        $this->resetFields();

        $this->mode = 'create';

        // @phpstan-ignore-next-line
        Flux::modal('task-modal')->show();
    }

    public function create(): void
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

        $this->dispatch('create-task', data: $data);
    }

    #[On('open-modal-update')]
    public function updateTask(Task $task): void
    {
        $this->resetFields();

        $this->mode = 'update';

        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->body = $task->body;
        $this->date = Carbon::parse($task->date)->format('Y-m-d');
        $this->author_id = $task->author_id;
        $this->status = $task->status;

        // @phpstan-ignore-next-line
        Flux::modal('task-modal')->show();
    }

    public function update(): void
    {
        $task = Task::find($this->taskId);

        $data = [
            'title' => $this->title,
            'body' => $this->body,
            'date' => $this->date,
            'author_id' => $this->author_id,
            'status' => $this->status,
        ];

        if ($this->file) {
            if ($task->file) {
                Storage::delete($task->file);
            }
            $path = $this->file->store('files');
            $data['file'] = $path;
        }

        $this->dispatch('update-task', $data, $task);
    }

    public function resetFields(): void
    {
        $this->title = '';
        $this->body = '';
        $this->date = '';
        $this->author_id = 0;
        $this->status = '';
    }

    public function render(): View
    {
        return view('livewire.Components.modal');
    }
}
