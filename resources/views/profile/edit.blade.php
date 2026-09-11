<x-app-layout>
    <x-slot name="header">
        <x-page-header :eyebrow="__('الحساب')">{{ __('الملف الشخصي') }}</x-page-header>
    </x-slot>

    <div class="mx-auto flex max-w-2xl flex-col gap-6">
        <div class="card p-6 sm:p-8">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="card p-6 sm:p-8">
            @include('profile.partials.update-password-form')
        </div>

        <div class="card p-6 sm:p-8">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
