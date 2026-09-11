@props(['status'])

@php
$map = [
    'todo' => [__('قيد الانتظار'), 'badge-gray'],
    'in_progress' => [__('قيد التنفيذ'), 'badge-blue'],
    'done' => [__('مكتملة'), 'badge-emerald'],
];
[$label, $class] = $map[$status] ?? [$status, 'badge-gray'];
@endphp

<span {{ $attributes->merge(['class' => $class]) }}>{{ $label }}</span>
