<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">مشروع جديد</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-xl px-4">
            <form action="{{ route('projects.store') }}" method="POST"
                  class="space-y-5 rounded-xl bg-white p-6 shadow">
                @csrf

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">اسم المشروع</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">الوصف</label>
                    <textarea name="description" rows="3"
                              class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">اللون</label>
                    <input type="color" name="color" value="{{ old('color', '#4f46e5') }}"
                           class="h-10 w-20 rounded border-gray-300">
                    @error('color') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                        حفظ
                    </button>
                    <a href="{{ route('projects.index') }}"
                       class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>