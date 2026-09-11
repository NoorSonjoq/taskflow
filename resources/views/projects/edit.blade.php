<x-app-layout>
    <x-slot name="header">
        <x-page-header :eyebrow="__('مشاريع')">{{ __('تعديل المشروع') }}</x-page-header>
    </x-slot>

    <div class="mx-auto max-w-xl">
        <form action="{{ route('projects.update', $project) }}" method="POST" class="card flex flex-col gap-5 p-6">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="name" :value="__('اسم المشروع')" />
                <x-text-input id="name" type="text" name="name" :value="old('name', $project->name)" required autofocus />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('الوصف')" />
                <textarea id="description" name="description" rows="3" class="field">{{ old('description', $project->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="color" :value="__('اللون')" />
                <input id="color" type="color" name="color" value="{{ old('color', $project->color) }}" class="h-10 w-20 rounded-lg border border-gray-300 p-1">
                <x-input-error :messages="$errors->get('color')" />
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">{{ __('تحديث') }}</button>
                <a href="{{ route('projects.index') }}" class="btn-secondary">{{ __('إلغاء') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
