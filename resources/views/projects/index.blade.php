<x-app-layout>
    <x-slot name="header">
        <x-page-header>
            <x-slot:eyebrow>{{ __('المشاريع') }} &middot; <bdi>{{ $projects->total() }}</bdi></x-slot:eyebrow>
            {{ __('مشاريعي') }}
            <x-slot:actions>
                <a href="{{ route('projects.create') }}" class="btn-primary">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    {{ __('مشروع جديد') }}
                </a>
            </x-slot:actions>
        </x-page-header>
    </x-slot>

    <div class="flex flex-col gap-8">

        @if ($projects->isEmpty())
            <div class="card p-10 text-center">
                <p class="text-gray-500 dark:text-gray-400">{{ __('لا يوجد مشاريع بعد. ابدأ بإنشاء أول مشروع.') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <div class="card flex flex-col gap-3 p-5">
                        <div class="flex items-start justify-between gap-3">
                            <a href="{{ route('projects.show', $project) }}" class="flex items-center gap-2.5">
                                <span class="h-3 w-3 shrink-0 rounded-full" style="background:{{ $project->color }};"></span>
                                <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $project->name }}</span>
                            </a>
                            <span class="badge-gray shrink-0"><bdi>{{ $project->tasks_count }}</bdi> {{ __('مهمة') }}</span>
                        </div>
                        <p class="line-clamp-2 flex-1 text-sm text-gray-500 dark:text-gray-400">{{ $project->description ?: __('بدون وصف') }}</p>
                        <div class="flex items-center gap-4 border-t border-gray-100 pt-3 text-sm dark:border-gray-700">
                            <a href="{{ route('projects.edit', $project) }}" class="font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">{{ __('تعديل') }}</a>
                            <x-confirm-form
                                :action="route('projects.destroy', $project)"
                                :title="__('حذف المشروع')"
                                :message="__('متأكد من حذف مشروع «:name»؟ رح ينحذف معه كل مهامه ووسومه.', ['name' => $project->name])"
                                class="font-medium text-rose-600 hover:text-rose-700"
                            >{{ __('حذف') }}</x-confirm-form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tnum">
                {{ $projects->links() }}
            </div>
        @endif

    </div>
</x-app-layout>
