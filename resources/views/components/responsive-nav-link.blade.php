@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-2.5 text-start text-sm font-medium text-white bg-white/10 rounded-lg transition-all duration-200'
            : 'block w-full ps-4 pe-4 py-2.5 text-start text-sm font-medium text-dark-400 hover:text-white hover:bg-white/5 rounded-lg transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
