@props(['eyebrow' => null])

<div class="flex flex-wrap items-end justify-between gap-4">
    <div class="flex flex-col gap-1.5">
        @isset($eyebrow)
            <span class="page-eyebrow">{{ $eyebrow }}</span>
        @endisset
        <h1 class="text-3xl font-bold text-gray-900 text-gray-900">{{ $slot }}</h1>
    </div>

    @isset($actions)
        <div class="flex items-center gap-3">
            {{ $actions }}
        </div>
    @endisset
</div>