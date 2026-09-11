@props(['task'])

@php
    $options = [
        'todo' => [__('قيد الانتظار'), 'badge-gray'],
        'in_progress' => [__('قيد التنفيذ'), 'badge-blue'],
        'done' => [__('مكتملة'), 'badge-emerald'],
    ];
    [$currentLabel, $currentClass] = $options[$task->status];
@endphp

<div x-data="{ open: false }" class="relative">
    <button type="button" @click="open = !open" @click.outside="open = false" class="{{ $currentClass }} cursor-pointer">
        {{ $currentLabel }}
        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>

    <div
        x-show="open"
        x-cloak
        x-transition
        style="display:none;"
        class="absolute end-0 z-10 mt-1 flex w-40 flex-col gap-1 rounded-lg border border-gray-200 bg-white p-1 shadow-lg dark:border-gray-700 dark:bg-gray-800"
    >
        @foreach ($options as $value => [$label, $class])
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="title" value="{{ $task->title }}">
                <input type="hidden" name="priority" value="{{ $task->priority }}">
                <input type="hidden" name="due_date" value="{{ $task->due_date?->format('Y-m-d') }}">
                <input type="hidden" name="status" value="{{ $value }}">
                <button
                    type="submit"
                    class="flex w-full items-center justify-between rounded-md px-2 py-1.5 text-start text-xs hover:bg-gray-50 dark:hover:bg-gray-700 {{ $value === $task->status ? 'ring-1 ring-inset ring-gray-200 dark:ring-gray-600' : '' }}"
                >
                    <span class="{{ $class }}">{{ $label }}</span>
                    @if ($value === $task->status)
                        <svg class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    @endif
                </button>
            </form>
        @endforeach
    </div>
</div>
