<x-app-layout>
    <x-slot name="header">
        <x-page-header :eyebrow="__('تعديل')">{{ __('تعديل المهمة') }}</x-page-header>
    </x-slot>

    <div class="mx-auto flex max-w-xl flex-col gap-6">
        <form action="{{ route('tasks.update', $task) }}" method="POST" class="card flex flex-col gap-5 p-6">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="title" :value="__('العنوان')" />
                <x-text-input id="title" type="text" name="title" :value="old('title', $task->title)" />
                <x-input-error :messages="$errors->get('title')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('الوصف')" />
                <textarea id="description" name="description" rows="3" class="field">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                <div>
                    <x-input-label for="status" :value="__('الحالة')" />
                    <select id="status" name="status" class="field">
                        <option value="todo" @selected($task->status === 'todo')>{{ __('قيد الانتظار') }}</option>
                        <option value="in_progress" @selected($task->status === 'in_progress')>{{ __('قيد التنفيذ') }}</option>
                        <option value="done" @selected($task->status === 'done')>{{ __('مكتملة') }}</option>
                    </select>
                </div>

                <div>
                    <x-input-label for="priority" :value="__('الأولوية')" />
                    <select id="priority" name="priority" class="field">
                        <option value="low" @selected($task->priority === 'low')>{{ __('منخفضة') }}</option>
                        <option value="medium" @selected($task->priority === 'medium')>{{ __('متوسطة') }}</option>
                        <option value="high" @selected($task->priority === 'high')>{{ __('عالية') }}</option>
                    </select>
                </div>

                <div>
                    <x-input-label for="due_date" :value="__('تاريخ الاستحقاق')" />
                    <x-text-input id="due_date" type="date" name="due_date" class="tnum"
                                  :value="old('due_date', $task->due_date?->format('Y-m-d'))" />
                </div>
            </div>

            <div>
                <x-input-label for="tags" :value="__('الوسوم')" />
                <x-text-input id="tags" type="text" name="tags"
                              :value="old('tags', $task->tags->pluck('name')->implode(', '))" />
                <p class="field-hint">{{ __('افصل بفاصلة. امسح وسم لحذفه، أو فرّغ الحقل لحذف كل الوسوم.') }}</p>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">{{ __('حفظ التعديلات') }}</button>
                <a href="{{ route('projects.show', $task->project) }}" class="btn-secondary">{{ __('إلغاء') }}</a>
            </div>
        </form>

        {{-- ملاحظات المهمة --}}
        <div class="card flex flex-col gap-5 p-6">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                {{ __('الملاحظات') }}
                <span class="text-gray-400 dark:text-gray-500">({{ $task->notes->count() }})</span>
            </h3>

            <form action="{{ route('tasks.notes.store', $task) }}" method="POST" class="flex flex-col gap-2">
                @csrf
                <textarea name="body" rows="2" placeholder="{{ __('أضف ملاحظة على هاي المهمة...') }}" class="field">{{ old('body') }}</textarea>
                <x-input-error :messages="$errors->get('body')" />
                <button type="submit" class="btn-primary self-start">{{ __('إضافة ملاحظة') }}</button>
            </form>

            @if ($task->notes->isEmpty())
                <p class="text-sm text-gray-400 dark:text-gray-500">{{ __('ما في ملاحظات بعد.') }}</p>
            @else
                <ul class="flex flex-col gap-3">
                    @foreach ($task->notes as $note)
                        <li class="rounded-lg border border-gray-100 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-900/40">
                            <div class="flex items-start justify-between gap-3">
                                <p class="whitespace-pre-line text-sm text-gray-700 dark:text-gray-300">{{ $note->body }}</p>
                                <x-confirm-form
                                    :action="route('tasks.notes.destroy', [$task, $note])"
                                    :title="__('حذف الملاحظة')"
                                    :message="__('متأكد من حذف هاي الملاحظة؟')"
                                    class="text-gray-400 hover:text-rose-600 dark:text-gray-500 dark:hover:text-rose-400"
                                >
                                    <span title="{{ __('حذف الملاحظة') }}">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </span>
                                </x-confirm-form>
                            </div>
                            <p class="mt-2 text-xs text-gray-400 dark:text-gray-500">
                                {{ $note->user->name }} &middot;
                                <span class="tnum">{{ $note->created_at->format('Y-m-d H:i') }}</span>
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
