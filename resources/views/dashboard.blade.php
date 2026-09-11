<x-app-layout>
    <x-slot name="header">
        <x-page-header>
            <x-slot:eyebrow><span class="tnum">{{ now()->translatedFormat('l، d M Y') }}</span></x-slot:eyebrow>
            {{ __('أهلاً :name ', ['name' => auth()->user()->name]) }}
            <x-slot:actions>
                <a href="{{ route('tasks.index') }}" class="btn-primary">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    {{ __('مهمة جديدة') }}
                </a>
            </x-slot:actions>
        </x-page-header>
    </x-slot>

    <div class="flex flex-col gap-10">

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
            <div class="card p-5">
                <p class="tnum text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['tasks'] }}</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('إجمالي المهام') }}</p>
            </div>
            <div class="card p-5">
                <p class="tnum text-3xl font-bold text-blue-600">{{ $stats['in_progress'] }}</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('قيد التنفيذ') }}</p>
            </div>
            <div class="card p-5">
                <p class="tnum text-3xl font-bold text-emerald-600">{{ $stats['done'] }}</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('مكتملة') }}</p>
            </div>
            <div class="card p-5">
                <p class="tnum text-3xl font-bold text-gray-500 dark:text-gray-400">{{ $stats['todo'] }}</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('قيد الانتظار') }}</p>
            </div>
            <div class="card p-5">
                <p class="tnum text-3xl font-bold text-rose-600">{{ $stats['overdue'] }}</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('متأخرة') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-5">

            <div class="card flex flex-col gap-4 p-6 lg:col-span-3">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('مهام اليوم') }}</h2>
                @if ($todayTasks->isEmpty())
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('ما في مهام مستحقة اليوم.') }}</p>
                @else
                    <div class="-mx-2 overflow-x-auto">
                        <table class="table-clean">
                            <thead>
                                <tr>
                                    <th>{{ __('المهمة') }}</th>
                                    <th>{{ __('المشروع') }}</th>
                                    <th>{{ __('الأولوية') }}</th>
                                    <th>{{ __('التاريخ') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todayTasks as $task)
                                    <tr>
                                        <td class="font-medium {{ $task->status === 'done' ? 'text-gray-400 line-through dark:text-gray-500' : 'text-gray-900 dark:text-gray-100' }}">
                                            {{ $task->title }}
                                        </td>
                                        <td>{{ $task->project->name }}</td>
                                        <td><x-priority-badge :priority="$task->priority" /></td>
                                        <td class="tnum">{{ $task->due_date->format('m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="card flex flex-col gap-5 p-6 lg:col-span-2">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('تقدّم الأسبوع') }}</h2>
                <div class="flex flex-col gap-4">
                    @forelse ($projectProgress as $project)
                        @php $pct = $project->tasks_count > 0 ? round($project->done_tasks_count / $project->tasks_count * 100) : 0; @endphp
                        <div class="flex flex-col gap-1.5">
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-medium text-gray-700 dark:text-gray-300">{{ $project->name }}</span>
                                <span class="tnum text-gray-400 dark:text-gray-500" dir="ltr">{{ $project->done_tasks_count }} / {{ $project->tasks_count }}</span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-700">
                                <div class="h-2 rounded-full bg-brand-600" style="width:{{ $pct }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('أنشئ مشروعك الأول لمتابعة التقدّم.') }}</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
