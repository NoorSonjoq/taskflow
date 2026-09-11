<x-app-layout>
    <x-slot name="header">
        <x-page-header>
            <x-slot:eyebrow>{{ __('كل المهام') }} &middot; <bdi>{{ $tasks->total() }}</bdi></x-slot:eyebrow>
            {{ __('كل المهام') }}
        </x-page-header>
    </x-slot>

    <div class="flex flex-col gap-8" x-data="{ open: {{ old('title') || $errors->any() ? 'true' : 'false' }} }">

        <div class="flex justify-end">
            <button type="button" @click="open = !open" class="btn-primary">
                <span x-show="!open" class="flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    {{ __('إضافة مهمة') }}
                </span>
                <span x-show="open" style="display:none;">{{ __('إخفاء') }}</span>
            </button>
        </div>

        <form method="GET" action="{{ route('tasks.index') }}" class="card flex flex-wrap items-end gap-3 p-4">
            <div class="min-w-[220px] flex-1">
                <input type="text" name="search" value="{{ request('search') }}" class="field" placeholder="{{ __('بحث بعنوان المهمة…') }}">
            </div>
            <select name="status" class="field w-auto">
                <option value="">{{ __('كل الحالات') }}</option>
                <option value="todo" @selected(request('status') === 'todo')>{{ __('قيد الانتظار') }}</option>
                <option value="in_progress" @selected(request('status') === 'in_progress')>{{ __('قيد التنفيذ') }}</option>
                <option value="done" @selected(request('status') === 'done')>{{ __('مكتملة') }}</option>
            </select>
            <select name="priority" class="field w-auto">
                <option value="">{{ __('كل الأولويات') }}</option>
                <option value="low" @selected(request('priority') === 'low')>{{ __('منخفضة') }}</option>
                <option value="medium" @selected(request('priority') === 'medium')>{{ __('متوسطة') }}</option>
                <option value="high" @selected(request('priority') === 'high')>{{ __('عالية') }}</option>
            </select>
            <button type="submit" class="btn-secondary">{{ __('فلترة') }}</button>
            @if (request()->hasAny(['search', 'status', 'priority']))
                <a href="{{ route('tasks.index') }}" class="btn-ghost">{{ __('إعادة تعيين') }}</a>
            @endif
        </form>

        <div x-show="open" x-cloak x-transition class="card flex flex-col gap-4 p-6" style="display:none;">
            <h3 class="font-bold text-gray-900 dark:text-white">{{ __('مهمة جديدة') }}</h3>

            @if ($projects->isEmpty())
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('لازم تنشئ مشروع أول.') }}
                    <a href="{{ route('projects.create') }}" class="font-medium text-brand-600 hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300">{{ __('أنشئ مشروع') }}</a>
                </p>
            @else
                <form action="{{ route('tasks.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                        <input type="text" name="title" class="field lg:col-span-2" placeholder="{{ __('عنوان المهمة') }}" value="{{ old('title') }}">

                        <select name="project_id" class="field">
                            <option value="">{{ __('اختر المشروع') }}</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>{{ $project->name }}</option>
                            @endforeach
                        </select>

                        <select name="status" class="field">
                            <option value="todo" @selected(old('status', 'todo') === 'todo')>{{ __('قيد الانتظار') }}</option>
                            <option value="in_progress" @selected(old('status') === 'in_progress')>{{ __('قيد التنفيذ') }}</option>
                            <option value="done" @selected(old('status') === 'done')>{{ __('مكتملة') }}</option>
                        </select>

                        <select name="priority" class="field">
                            <option value="medium" @selected(old('priority', 'medium') === 'medium')>{{ __('أولوية متوسطة') }}</option>
                            <option value="high" @selected(old('priority') === 'high')>{{ __('أولوية عالية') }}</option>
                            <option value="low" @selected(old('priority') === 'low')>{{ __('أولوية منخفضة') }}</option>
                        </select>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <input type="date" name="due_date" value="{{ old('due_date') }}" class="field tnum">
                        <input type="text" name="tags" value="{{ old('tags') }}" class="field" placeholder="{{ __('وسوم (مثال: مهم, شغل)') }}">
                    </div>

                    @if ($errors->any())
                        <x-input-error :messages="$errors->all()" />
                    @endif

                    <button type="submit" class="btn-primary self-start">{{ __('إضافة المهمة') }}</button>
                </form>
            @endif
        </div>

        <div class="card overflow-x-auto p-2">
            <table class="table-clean min-w-[720px]">
            <thead>
                <tr>
                    <th>{{ __('المهمة') }}</th><th>{{ __('المشروع') }}</th><th>{{ __('الحالة') }}</th><th>{{ __('الأولوية') }}</th><th>{{ __('التاريخ') }}</th><th>{{ __('الوسوم') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td class="font-medium {{ $task->status === 'done' ? 'text-gray-400 line-through dark:text-gray-500' : 'text-gray-900 dark:text-gray-100' }}">
                            {{ $task->title }}
                        </td>
                        <td><a href="{{ route('projects.show', $task->project) }}" class="text-brand-600 hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300">{{ $task->project->name }}</a></td>
                        <td><x-status-badge :status="$task->status" /></td>
                        <td><x-priority-badge :priority="$task->priority" /></td>
                        <td class="tnum">{{ $task->due_date?->format('Y-m-d') }}</td>
                        <td class="text-gray-500 dark:text-gray-400">
                            @foreach ($task->tags as $tag)
                                <span class="badge-gray">#{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-gray-400 dark:text-gray-500">{{ __('ما في مهام مطابقة.') }}</td></tr>
                @endforelse
            </tbody>
            </table>
        </div>

        <div class="tnum">
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>
