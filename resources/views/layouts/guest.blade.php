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
        <div class="grid min-h-screen lg:grid-cols-2">

            <div class="hidden flex-col justify-between bg-brand-700 p-12 text-white lg:flex xl:p-16"
                 style="background-image: radial-gradient(circle at 15% 15%, rgba(255,255,255,0.12), transparent 45%), radial-gradient(circle at 85% 85%, rgba(255,255,255,0.10), transparent 45%);">
                <a href="{{ route('login') }}" class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15 p-1.5">
                        <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6.5h12M4 12h12M4 17.5h7" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.5 14l1.75 1.75L23 12" />
                        </svg>
                    </span>
                    <span class="text-2xl font-bold">TaskFlow</span>
                </a>

                <div class="flex flex-col gap-6">
                    <p class="max-w-md text-3xl font-bold leading-snug">
                        {{ __('مهامك ومشاريعك بمكان واحد، بدون فوضى وبدون ما تنسى شي.') }}
                    </p>
                    <ul class="flex flex-col gap-3 text-brand-100">
                        <li class="flex items-center gap-3">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            {{ __('نظّم مشاريعك ومهامك بسهولة') }}
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            {{ __('تابع التقدّم والمواعيد المستحقة') }}
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            {{ __('تنبيهات بالبريد قبل موعد التسليم') }}
                        </li>
                    </ul>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm text-brand-200">&copy; {{ date('Y') }} TaskFlow</span>
                    <x-locale-switcher class="text-brand-100 hover:text-white" />
                </div>
            </div>

            <div class="flex items-center justify-center px-6 py-12 sm:px-10">
                <div class="flex w-full max-w-sm flex-col gap-7">
                    <div class="flex items-center justify-between lg:hidden">
                        <a href="{{ route('login') }}" class="flex items-center gap-2.5">
                            <x-application-logo class="h-9 w-9" />
                            <span class="text-xl font-bold text-gray-900 dark:text-white">TaskFlow</span>
                        </a>
                        <x-locale-switcher class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" />
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
