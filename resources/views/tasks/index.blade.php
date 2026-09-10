<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">كل المهام</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 space-y-6">

            @if (session('success'))
                <div class="rounded-lg bg-green-100 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- الفلترة --}}
            <div class="rounded-xl bg-white p-4 shadow">
                <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap items-end gap-4">
                                        <div>
                        <label class="mb-1 block text-xs font-medium text-gray-600">بحث</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="عنوان المهمة..."
                               class="rounded-lg border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium text-gray-600">الحالة</label>
                        <select name="status" class="rounded-lg border-gray-300 text-sm">
                            <option value="">الكل</option>
                            <option value="todo" @selected(request('status') === 'todo')>قيد الانتظار</option>
                            <option value="in_progress" @selected(request('status') === 'in_progress')>قيد التنفيذ</option>
                            <option value="done" @selected(request('status') === 'done')>مكتملة</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-medium text-gray-600">الأولوية</label>
                        <select name="priority" class="rounded-lg border-gray-300 text-sm">
                            <option value="">الكل</option>
                            <option value="low" @selected(request('priority') === 'low')>منخفضة</option>
                            <option value="medium" @selected(request('priority') === 'medium')>متوسطة</option>
                            <option value="high" @selected(request('priority') === 'high')>عالية</option>
                        </select>
                    </div>

                    <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                        فلترة
                    </button>

                    <a href="{{ route('tasks.index') }}"
                       class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                        إعادة تعيين
                    </a>
                </form>
            </div>

            {{-- قائمة المهام --}}
            <div class="space-y-3">
                <h3 class="font-semibold text-gray-800">النتائج ({{ $tasks->count() }})</h3>

                @forelse ($tasks as $task)
                    <div class="flex items-center justify-between rounded-xl bg-white p-4 shadow">
                        <div>
                            <p class="font-medium text-gray-800 {{ $task->status === 'done' ? 'line-through text-gray-400' : '' }}">
                                {{ $task->title }}
                            </p>
                            <div class="mt-1 flex flex-wrap gap-2 text-xs">
                                {{-- اسم المشروع التابع له --}}
                                <a href="{{ route('projects.show', $task->project) }}"
                                   class="rounded-full bg-indigo-50 px-2 py-0.5 text-indigo-700 hover:underline">
                                    {{ $task->project->name }}
                                </a>

                                <span class="rounded-full px-2 py-0.5
                                    @if($task->priority === 'high') bg-red-100 text-red-700
                                    @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-600 @endif">
                                    {{ ['low' => 'منخفضة', 'medium' => 'متوسطة', 'high' => 'عالية'][$task->priority] }}
                                </span>

                                <span class="rounded-full px-2 py-0.5
                                    @if($task->status === 'done') bg-green-100 text-green-700
                                    @elseif($task->status === 'in_progress') bg-blue-100 text-blue-700
                                    @else bg-gray-100 text-gray-600 @endif">
                                    {{ ['todo' => 'قيد الانتظار', 'in_progress' => 'قيد التنفيذ', 'done' => 'مكتملة'][$task->status] }}
                                </span>

                                @if ($task->due_date)
                                    <span class="text-gray-400">📅 {{ $task->due_date->format('Y-m-d') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="rounded-xl bg-white p-6 text-center text-gray-400 shadow">
                        ما في مهام مطابقة.
                    </p>
                @endforelse

                <div class="mt-4">
                    {{ $tasks->links() }}
                </div>
            </div>
                                   {{-- إضافة مهمة سريعة --}}
            <div x-data="{ open: false }">
                <button @click="open = !open"
                        class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                    <span x-show="!open">+ إضافة مهمة</span>
                    <span x-show="open">− إخفاء</span>
                </button>

                <div x-show="open" x-collapse class="mt-3 rounded-xl bg-white p-6 shadow">
                    @if ($projects->isEmpty())
                        <p class="text-sm text-gray-500">
                            لازم تنشئ مشروع أول.
                            <a href="{{ route('projects.create') }}" class="text-indigo-600 hover:underline">أنشئ مشروع</a>
                        </p>
                    @else
                        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                            @csrf

                            <div class="grid gap-4 sm:grid-cols-2">
                                <input type="text" name="title" placeholder="عنوان المهمة" value="{{ old('title') }}"
                                       class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                                <select name="project_id" class="rounded-lg border-gray-300">
                                    <option value="">اختر المشروع</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
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

                            <input type="text" name="tags" placeholder="وسوم (مثال: مهم, شغل)" value="{{ old('tags') }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                            <button type="submit"
                                    class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                                إضافة المهمة
                            </button>
                        </form>
                    @endif
                </div>
            </div>
    </div>
</x-app-layout>