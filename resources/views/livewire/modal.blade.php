<div>
    <flux:modal name="action-task" class="md:w-100">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">ایجاد نوشته جدید</flux:heading>
            </div>
            <div class="flex gap-4">
                <flux:input label="عنوان" />
                <flux:input type="date" max="2999-12-31" label="Date" />
            </div>
            <flux:radio.group label="کاربر" variant="segmented">
                <flux:radio value="1" label="کاربر شماره 1" checked />
                <flux:radio value="2" label="کاربر شماره 2" />
                <flux:radio value="3" label="کاربر شماره 3" />
            </flux:radio.group>
            <flux:textarea label="توضیحات" />
            <flux:input type="file" label="فایل پیوست" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">ثبت و تایید</flux:button>
            </div>
        </div>
    </flux:modal>
</div>