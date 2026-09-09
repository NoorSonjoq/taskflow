<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">مشاريعي</h2>
            <a href="{{ route('projects.create') }}"
               class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                + مشروع جديد
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="mb-4 flex justify-end">
                <a href="{{ route('projects.create') }}"
                   class="inline-block rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                    + مشروع جديد
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($projects->isEmpty())
                <div class="rounded-xl bg-white p-10 text-center text-gray-500 shadow">
                    لا يوجد مشاريع متاحة . ابدأ بإنشاء أول مشروع 
                </div>
            @else
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($projects as $project)
                        <div class="rounded-xl bg-white p-5 shadow transition hover:shadow-md">
                            <div class="mb-3 flex items-center gap-2">
                                <span class="inline-block h-4 w-4 rounded-full"
                                      @style(['background: ' . $project->color])></span>
                                <h3 class="font-semibold text-gray-800">
                                    <a href="{{ route('projects.show', $project) }}" class="hover:text-indigo-600 hover:underline">
                                        {{ $project->name }}
                                    </a>
                                </h3>
                            </div>

                            <p class="mb-4 text-sm text-gray-500">
                                {{ $project->description ?: 'بدون وصف' }}
                            </p>

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">{{ $project->tasks_count }} مهمة</span>
                                <div class="flex gap-3">
                                    <a href="{{ route('projects.edit', $project) }}"
                                       class="text-indigo-600 hover:underline">تعديل</a>
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                          onsubmit="return confirm('متأكد من حذف المشروع؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>