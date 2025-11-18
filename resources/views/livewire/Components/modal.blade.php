<div>
    <flux:modal name="task-modal" class="md:w-120">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $mode === 'create' ? 'ایجاد نوشته جدید' : 'ویرایش نوشته' }}</flux:heading>
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
                @if ($mode === 'create')
                <flux:button type="submit" variant="primary" wire:click="create">ثبت و تایید</flux:button>
                @elseif ($mode === 'update')
                <flux:button type="submit" variant="primary" wire:click="update">به روز رسانی
                </flux:button>
                @endif
            </div>
        </div>
    </flux:modal>
</div>