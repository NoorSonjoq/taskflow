@props([
    'action',
    'method' => 'DELETE',
    'title' => null,
    'message' => null,
    'confirmLabel' => null,
])

@php
    $title ??= __('تأكيد الحذف');
    $message ??= __('هاد الإجراء ما ممكن يترجع، تأكد قبل ما تكمل.');
    $confirmLabel ??= __('تأكيد الحذف');
@endphp

<form
    action="{{ $action }}"
    method="POST"
    x-data="{ open: false }"
    @submit.prevent="open = true"
    @keydown.escape.window="open = false"
>
    @csrf
    @if (strtoupper($method) !== 'POST')
        @method($method)
    @endif

    <button type="submit" {{ $attributes }}>{{ $slot }}</button>

    {{-- نافذة التأكيد --}}
    <div
        x-show="open"
        x-cloak
        style="display:none;"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
    >
        <div class="absolute inset-0 bg-gray-900/50" @click="open = false"></div>

        <div x-show="open" x-transition class="card relative flex w-full max-w-sm flex-col gap-4 p-6">
            <div class="flex flex-col gap-1.5">
                <h3 class="text-base font-bold text-gray-900">{{ $title }}</h3>
                <p class="text-sm text-gray-500">{{ $message }}</p>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" class="btn-secondary btn-sm" @click="open = false">{{ __('إلغاء') }}</button>
                <button type="button" class="btn-danger-solid btn-sm" @click="open = false; $root.submit()">{{ $confirmLabel }}</button>
            </div>
        </div>
    </div>
</form>
