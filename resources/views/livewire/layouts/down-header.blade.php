<div>
    <div class="down-header flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <flux:dropdown>
                <flux:button icon:trailing="chevron-down">انتخاب کاربر</flux:button>

                <flux:menu>
                    <flux:menu.item icon="user" wire:click='findByUser(1)'>کاربر شماره 1</flux:menu.item>
                    <flux:menu.item icon="user" wire:click='findByUser(2)'>کاربر شماره 2</flux:menu.item>
                    <flux:menu.item icon="user" wire:click='findByUser(3)'>کاربر شماره 3</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </div>
        <div class="flex gap-4">
            <div class="flex">
                <flux:icon.adjustments-horizontal/>
                <flux:heading size="lg">فیلتر براساس:</flux:heading>
            </div>
            <div class="flex gap-4">
                <flux:link href="#" variant="subtle">همه</flux:link>
                <flux:link href="#" variant="subtle">انجام شده</flux:link>
                <flux:link href="#" variant="subtle">انجام نشده</flux:link>
            </div>
        </div>
    </div>
</div>
