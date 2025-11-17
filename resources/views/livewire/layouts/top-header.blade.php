<div>
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0">
        <div class="">
            <h1 class="font-bold text-2xl text-center">نوشته های من</h1>
        </div>
        <div class="flex gap-4">
            <flux:input icon="magnifying-glass" placeholder="جستجو کنید..." wire:model.live="search" />
            <flux:modal.trigger name="create-task">
                <flux:button variant="primary" color="zinc"
                    class="cursor-pointer transition-all ease-in-out duration-300" icon="bolt">ایجاد نوشته جدید
                </flux:button>
            </flux:modal.trigger>
        </div>
    </div>
</div>