<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">تعديل المهمة</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-xl px-4">
            <form action="{{ route('tasks.update', $task) }}" method="POST"
                  class="space-y-4 rounded-xl bg-white p-6 shadow">
                @csrf
                @method('PUT')

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">العنوان</label>
                    <input type="text" name="title" value="{{ old('title', $task->title) }}"
                           class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">الوصف</label>
                    <textarea name="description" rows="3"
                              class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">الحالة</label>
                        <select name="status" class="w-full rounded-lg border-gray-300">
                            <option value="todo" @selected($task->status === 'todo')>قيد الانتظار</option>
                            <option value="in_progress" @selected($task->status === 'in_progress')>قيد التنفيذ</option>
                            <option value="done" @selected($task->status === 'done')>مكتملة</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">الأولوية</label>
                        <select name="priority" class="w-full rounded-lg border-gray-300">
                            <option value="low" @selected($task->priority === 'low')>منخفضة</option>
                            <option value="medium" @selected($task->priority === 'medium')>متوسطة</option>
                            <option value="high" @selected($task->priority === 'high')>عالية</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">تاريخ الاستحقاق</label>
                        <input type="date" name="due_date"
                               value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">الوسوم</label>
                    <input type="text" name="tags"
                           value="{{ old('tags', $task->tags->pluck('name')->implode(', ')) }}"
                           class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <p class="mt-1 text-xs text-gray-400">افصل بفاصلة. امسح وسم لحذفه، أو فرّغ الحقل لحذف كل الوسوم.</p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                        حفظ التعديلات
                    </button>
                    <a href="{{ route('projects.show', $task->project) }}"
                       class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>