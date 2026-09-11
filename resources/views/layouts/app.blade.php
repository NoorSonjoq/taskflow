<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskFlow') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        @include('layouts.theme-script')

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <main>
                <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 md:px-10 md:py-12">
                    @if (session('success'))
                        {{-- ملاحظة: الرسالة نفسها متخزّنة مترجمة من الكنترولر عبر __() --}}
                        <div class="mb-8 rounded-lg bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    @isset($header)
                        <div class="mb-8">{{ $header }}</div>
                    @endisset

                    {{ $slot }}
                </div>
            </main>

            @include('layouts.footer')
        </div>
    </body>
</html>
