@php
    // بنعرض اسم اللغة التانية (يلي رح تنتقل إلها لو ضغطت)
    $other = app()->getLocale() === 'ar' ? 'en' : 'ar';
    $label = $other === 'ar' ? 'العربية' : 'English';
@endphp

<a
    href="{{ route('locale.update', $other) }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 text-sm font-medium transition-colors']) }}
>
    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.6 9h16.8M3.6 15h16.8M12 3a14.5 14.5 0 010 18M12 3a14.5 14.5 0 000 18" />
    </svg>
    {{ $label }}
</a>
