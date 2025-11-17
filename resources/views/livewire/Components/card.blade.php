<div>
    <div
        class="border border-1-white lg:w-[300px] xl:w-[400px] h-[220px] p-4 rounded-md bg-gradient-to-br {{ $status  }}   flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <div class="font-bold text-xl">{{ $title }}</div>
            <div class="flex gap-4">
                <div class="action-btn">
                    <flux:modal.trigger name="action-task">
                        <flux:icon.pencil-square class="text-gray-800" variant="mini" />
                    </flux:modal.trigger>
                </div>
                <div class="action-btn">
                    <flux:icon.trash class="text-gray-800" variant="mini" />
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