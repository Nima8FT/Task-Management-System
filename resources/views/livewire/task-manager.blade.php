<div class="flex flex-col gap-16">
    @livewire('layouts.header')
    <main class="grid lg:grid-cols-3 md:grid-cols-2 gap-8 place-items-center">
        @foreach($tasks as $task)
        @livewire('components.card', ['task' => $task], key($task->id))
        @endforeach
    </main>

    <form wire:submit='createTask'>
        <flux:modal name="create-task" class="md:w-120">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">ایجاد نوشته جدید</flux:heading>
                </div>
                <div class="flex gap-4">
                    <flux:input label="عنوان" wire:model='title' />
                    <flux:input type="date" max="2999-12-31" label="Date" wire:model='date' />
                </div>
                <flux:radio.group label="کاربر" variant="segmented" wire:model='author_id'>
                    <flux:radio value="1" label="کاربر شماره 1" checked />
                    <flux:radio value="2" label="کاربر شماره 2" />
                    <flux:radio value="3" label="کاربر شماره 3" />
                </flux:radio.group>
                <flux:radio.group label="وضعیت" variant="segmented" wire:model='status'>
                    <flux:radio value="completed" label="تکمیل شده" />
                    <flux:radio value="pending" label="در حال انجام" checked />
                </flux:radio.group>
                <flux:textarea label="توضیحات" wire:model='body' />
                <flux:input type="file" label="فایل پیوست" wire:model='file' />
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">ثبت و تایید</flux:button>
                </div>
            </div>
        </flux:modal>
    </form>
</div>