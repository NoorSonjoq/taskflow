<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskFlow') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
             style="background: linear-gradient(135deg, #020617 0%, #0f172a 50%, #1e1b4b 100%);">

            {{-- Logo --}}
            <div class="mb-2 animate-fade-in">
                <a href="/" class="flex flex-col items-center gap-3 group">
                    <div class="p-3 rounded-2xl" style="background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(168,85,247,0.1)); border: 1px solid rgba(99,102,241,0.2);">
                        <x-application-logo class="w-12 h-12" />
                    </div>
                    <span class="text-2xl font-bold gradient-text">TaskFlow</span>
                </a>
            </div>

            {{-- Auth Card --}}
            <div class="w-full sm:max-w-md mt-4 px-6 py-6 glass-card animate-slide-up overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
