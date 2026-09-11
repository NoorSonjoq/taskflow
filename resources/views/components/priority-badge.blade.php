@props(['priority'])

@php
$map = [
    'low' => [__('منخفضة'), 'badge-gray'],
    'medium' => [__('متوسطة'), 'badge-amber'],
    'high' => [__('عالية'), 'badge-rose'],
];
[$label, $class] = $map[$priority] ?? [$priority, 'badge-gray'];
@endphp

<span {{ $attributes->merge(['class' => $class]) }}>{{ $label }}</span>
