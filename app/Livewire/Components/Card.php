<?php

namespace App\Livewire\Components;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Card extends Component
{
    use WithFileUploads;

    public Task $task;

    public int $id;

    #[Validate('required|string|max:255')]
    public string $title;

    #[Validate('required|string')]
    public string $body;

    #[Validate('required|in:1,2,3')]
    public int $author_id;

    #[Validate('required|date')]
    public string $date;

    #[Validate('required|in:pending,completed')]
    public string $status;

    public string $size;

    #[Validate('nullable|file|max:1024')]
    public ?TemporaryUploadedFile $file = null;

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'title.required' => 'لطفاً عنوان را وارد کنید.',
            'body.required' => 'لطفا توضیحات را وارد کنید.',
            'date.required' => 'لطفا تاریخ را وارد کنید.',
            'author_id.required' => 'لطفا کاربر را انتخاب کنید.',
            'status.required' => 'لطفا وضعیت را انتخاب کنید.',
        ];
    }

    /**
     * Create a new component instance.
     */
    public function mount(Task $task): void
    {
        $this->syncFromTask($task);
    }

    public function openModal(Task $task): void
    {
        $this->dispatch('open-modal-update', task: $task);
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
        if ($task->id !== $this->id) {
            return;
        }

        $this->syncFromTask($task);
    }

    public function render(): View
    {
        return view('livewire.Components.card');
    }

    private function syncFromTask(Task $task): void
    {
        $this->task = $task;
        $this->id = $task->id;
        $this->title = Str::limit($task->title, 20, '...');
        $this->body = Str::limit($task->body, 250, '...');
        $this->author_id = $task->author_id;
        $this->date = Carbon::parse($task->date)->format('Y-m-d');
        // $this->date = $task->date;
        $this->status = $task->status;
        $this->size = $this->sizeFile($task);
    }
}
