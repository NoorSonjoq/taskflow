<x-app-layout>
    <x-slot name="header">
        <x-page-header :eyebrow="__('مشروع')">
            <span class="flex items-center gap-3">
                <span class="h-4 w-4 shrink-0 rounded-full" style="background:{{ $project->color }};"></span>
                {{ $project->name }}
            </span>
            <x-slot:actions>
                <a href="{{ route('projects.edit', $project) }}" class="btn-secondary">{{ __('تعديل المشروع') }}</a>
            </x-slot:actions>
        </x-page-header>
    </x-slot>

    <div class="flex flex-col gap-6">

        {{-- فورم إضافة مهمة --}}
        <div class="card p-6">
            <h3 class="mb-4 font-bold text-gray-900 dark:text-white">{{ __('إضافة مهمة') }}</h3>
            <form action="{{ route('tasks.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">

                <div>
                    <input type="text" name="title" placeholder="{{ __('عنوان المهمة') }}" value="{{ old('title') }}" class="field">
                    <x-input-error :messages="$errors->get('title')" />
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    <select name="status" class="field">
                        <option value="todo">{{ __('قيد الانتظار') }}</option>
                        <option value="in_progress">{{ __('قيد التنفيذ') }}</option>
                        <option value="done">{{ __('مكتملة') }}</option>
                    </select>

                    <select name="priority" class="field">
                        <option value="low">{{ __('أولوية منخفضة') }}</option>
                        <option value="medium" selected>{{ __('أولوية متوسطة') }}</option>
                        <option value="high">{{ __('أولوية عالية') }}</option>
                    </select>

                    <input type="date" name="due_date" value="{{ old('due_date') }}" class="field tnum">
                </div>

                <div>
                    <input type="text" name="tags" placeholder="{{ __('وسوم (مثال: مهم, شغل)') }}" value="{{ old('tags') }}" class="field">
                    <p class="field-hint">{{ __('افصل الوسوم بفاصلة') }}</p>
                </div>

                <button type="submit" class="btn-primary self-start">{{ __('إضافة المهمة') }}</button>
            </form>
        </div>

        {{-- قائمة المهام --}}
        <div class="flex flex-col gap-3">
            <h3 class="font-bold text-gray-900 dark:text-white">{{ __('المهام') }} (<bdi>{{ $project->tasks->count() }}</bdi>)</h3>

            @forelse ($project->tasks as $task)
                <div class="card flex flex-wrap items-center justify-between gap-3 p-4">
                    <div class="flex flex-col gap-1.5">
                        <p class="font-medium {{ $task->status === 'done' ? 'text-gray-400 line-through dark:text-gray-500' : 'text-gray-900 dark:text-gray-100' }}">
                            {{ $task->title }}
                        </p>
                        <div class="flex flex-wrap items-center gap-2 text-xs">
                            <x-priority-badge :priority="$task->priority" />
                            @if ($task->due_date)
                                <span class="tnum text-gray-400 dark:text-gray-500">{{ $task->due_date->format('Y-m-d') }}</span>
                            @endif
                            @foreach ($task->tags as $tag)
                                <span class="badge-brand">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        {{-- تغيير الحالة --}}
                        <x-status-select :task="$task" />
                        <a href="{{ route('tasks.edit', $task) }}" class="text-sm font-medium text-brand-600 hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300">{{ __('تعديل') }}</a>
                        <x-confirm-form
                            :action="route('tasks.destroy', $task)"
                            :title="__('حذف المهمة')"
                            :message="__('متأكد من حذف مهمة «:name»؟', ['name' => $task->title])"
                            class="text-sm font-medium text-rose-600 hover:text-rose-700"
                        >{{ __('حذف') }}</x-confirm-form>
                    </div>
                </div>
            @empty
                <div class="card p-8 text-center text-gray-400 dark:text-gray-500">
                    {{ __('ما في مهام بعد. أضف أول مهمة 👆') }}
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
