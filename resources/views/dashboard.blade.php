<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">لوحة التحكم</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 space-y-6">

            <p class="text-gray-600">أهلاً {{ auth()->user()->name }} 👋 هاي نظرة سريعة على مهامك.</p>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">المشاريع</p>
                    <p class="mt-2 text-3xl font-bold text-indigo-600">{{ $stats['projects'] }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">إجمالي المهام</p>
                    <p class="mt-2 text-3xl font-bold text-gray-800">{{ $stats['tasks'] }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">مكتملة</p>
                    <p class="mt-2 text-3xl font-bold text-green-600">{{ $stats['done'] }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">قيد التنفيذ</p>
                    <p class="mt-2 text-3xl font-bold text-blue-600">{{ $stats['in_progress'] }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">قيد الانتظار</p>
                    <p class="mt-2 text-3xl font-bold text-gray-600">{{ $stats['todo'] }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">متأخرة</p>
                    <p class="mt-2 text-3xl font-bold text-red-600">{{ $stats['overdue'] }}</p>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('projects.index') }}"
                   class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                    مشاريعي
                </a>
                <a href="{{ route('tasks.index') }}"
                   class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    كل المهام
                </a>
            </div>

        </div>
    </div>
</x-app-layout>