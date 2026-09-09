<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="inline-block h-4 w-4 rounded-full" @style(['background: ' . $project->color])></span>
            <h2 class="text-xl font-semibold text-gray-800">{{ $project->name }}</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 space-y-6">

            @if (session('success'))
                <div class="rounded-lg bg-green-100 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- فورم إضافة مهمة --}}
            <div class="rounded-xl bg-white p-6 shadow">
                <h3 class="mb-4 font-semibold text-gray-800">+ إضافة مهمة</h3>
                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">

                    <div>
                        <input type="text" name="title" placeholder="عنوان المهمة"
                               value="{{ old('title') }}"
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <select name="status" class="rounded-lg border-gray-300">
                            <option value="todo">قيد الانتظار</option>
                            <option value="in_progress">قيد التنفيذ</option>
                            <option value="done">مكتملة</option>
                        </select>

                        <select name="priority" class="rounded-lg border-gray-300">
                            <option value="low">أولوية منخفضة</option>
                            <option value="medium" selected>أولوية متوسطة</option>
                            <option value="high">أولوية عالية</option>
                        </select>

                        <input type="date" name="due_date" value="{{ old('due_date') }}"
                               class="rounded-lg border-gray-300">
                    </div>

                    <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                        إضافة المهمة
                    </button>
                </form>
            </div>

            {{-- قائمة المهام --}}
            <div class="space-y-3">
                <h3 class="font-semibold text-gray-800">المهام ({{ $project->tasks->count() }})</h3>

                @forelse ($project->tasks as $task)
                    <div class="flex items-center justify-between rounded-xl bg-white p-4 shadow">
                        <div>
                            <p class="font-medium text-gray-800 {{ $task->status === 'done' ? 'line-through text-gray-400' : '' }}">
                                {{ $task->title }}
                            </p>
                            <div class="mt-1 flex gap-2 text-xs">
                                <span class="rounded-full px-2 py-0.5
                                    @if($task->priority === 'high') bg-red-100 text-red-700
                                    @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-600 @endif">
                                    {{ ['low' => 'منخفضة', 'medium' => 'متوسطة', 'high' => 'عالية'][$task->priority] }}
                                </span>
                                @if ($task->due_date)
                                    <span class="text-gray-400">📅 {{ $task->due_date->format('Y-m-d') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            {{-- تغيير الحالة --}}
                            <form action="{{ route('tasks.update', $task) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="title" value="{{ $task->title }}">
                                <input type="hidden" name="priority" value="{{ $task->priority }}">
                                <input type="hidden" name="due_date" value="{{ $task->due_date?->format('Y-m-d') }}">
                                <select name="status" onchange="this.form.submit()"
                                        class="rounded-lg border-gray-300 text-xs">
                                    <option value="todo" @selected($task->status === 'todo')>قيد الانتظار</option>
                                    <option value="in_progress" @selected($task->status === 'in_progress')>قيد التنفيذ</option>
                                    <option value="done" @selected($task->status === 'done')>مكتملة</option>
                                </select>
                            </form>

                            {{-- حذف --}}
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                  onsubmit="return confirm('حذف المهمة؟')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline text-sm">حذف</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="rounded-xl bg-white p-6 text-center text-gray-400 shadow">
                        ما في مهام بعد. أضف أول مهمة 👆
                    </p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>