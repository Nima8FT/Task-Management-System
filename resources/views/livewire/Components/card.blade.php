<div>
    <div
        class="border border-1-white lg:w-[300px] xl:w-[400px] h-[220px] p-4 rounded-md bg-gradient-to-br {{ $status  }}   flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <div class="font-bold text-xl">{{ $title }}</div>
            <div class="flex gap-4">
                <div class="action-btn">
                    <flux:modal.trigger :name="'update-task'.$id">
                        <flux:icon.pencil-square class="text-gray-800" variant="mini" />
                    </flux:modal.trigger>
                    <form wire:submit.prevent='updateTask({{ $id }})'>
                        <flux:modal :name="'update-task'.$id" class="md:w-100">
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
                                <flux:textarea label="توضیحات" wire:model='body' />
                                <flux:input type="file" label="فایل پیوست" wire:model='file' />
                                <div class="flex">
                                    <flux:spacer />
                                    <flux:button type="submit" variant="primary">به روز رسانی</flux:button>
                                </div>
                            </div>
                        </flux:modal>
                    </form>
                </div>
                <div class="action-btn">
                    <flux:modal.trigger :name="'delete-task'.$id">
                        <flux:icon.trash class="text-gray-800 cursor-pointer" variant="mini" />
                    </flux:modal.trigger>
                    <form wire:submit.prevent='deleteTask({{ $id }})'>
                        <flux:modal :name="'delete-task'.$id" class="min-w-[22rem]">
                            <div class="space-y-6">
                                <div>
                                    <flux:heading size="lg">ایا مطمین به حذف هستید ؟</flux:heading>
                                </div>
                                <div class="flex gap-2">
                                    <flux:spacer />
                                    <flux:modal.close>
                                        <flux:button variant="ghost">خیر</flux:button>
                                    </flux:modal.close>
                                    <flux:button type="submit" variant="danger">حذف</flux:button>
                                </div>
                            </div>
                        </flux:modal>
                    </form>
                </div>
            </div>
        </div>
        <div class="h-[90px]">
            <p class="text-sm">{{ $body }}</p>
        </div>
        <div class="flex justify-between border-t-1 border-gray-300/50">
            <div class="flex gap-2 items-center mt-4">
                <flux:icon.paper-clip variant="mini" />
                <p class="text-sm">فایل پیوست</p>
            </div>
            <div class="flex gap-2 items-center mt-4">
                <p>{{ $date }}</p>
                <flux:icon.calendar-days variant="mini" />
            </div>
        </div>
    </div>
</div>