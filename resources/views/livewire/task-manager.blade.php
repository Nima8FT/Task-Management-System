<div class="flex flex-col gap-16">
    @livewire('layouts.header')
    <main class="grid lg:grid-cols-3 md:grid-cols-2 gap-8 place-items-center">
        @foreach($tasks as $task)
            @livewire('components.card', ['task' => $task], key($task->id))
        @endforeach
    </main>
</div>
