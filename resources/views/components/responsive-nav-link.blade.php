@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-s-4 border-brand-500 text-start text-base font-medium text-brand-700 bg-brand-50 focus:outline-none transition'
            : 'block w-full ps-3 pe-4 py-2 border-s-4 border-transparent text-start text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 focus:outline-none transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
