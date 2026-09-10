@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg text-white bg-white/10 nav-active-dot transition-all duration-200'
            : 'inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg text-dark-400 hover:text-white hover:bg-white/5 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
