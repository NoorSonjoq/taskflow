<header
    class="border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800"
    x-data="{ mobileOpen: false, dark: document.documentElement.classList.contains('dark') }"
>
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3 sm:px-6 md:px-10">

        <div class="flex items-center gap-8">
            <a href="{{ route('dashboard') }}" class="flex shrink-0 items-center gap-2.5">
                <x-application-logo class="h-8 w-8" />
                <span class="text-lg font-bold text-gray-900 dark:text-white">TaskFlow</span>
            </a>

            <nav class="hidden items-center gap-1 md:flex">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
                    {{ __('لوحة التحكم') }}
                </a>
                <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'is-active' : '' }}">
                    {{ __('المشاريع') }}
                </a>
                <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.*') ? 'is-active' : '' }}">
                    {{ __('كل المهام') }}
                </a>
            </nav>
        </div>

        <div class="flex items-center gap-1">
            {{-- تبديل الوضع الداكن: ديسكتوب --}}
            <button
                type="button"
                @click="dark = !dark; document.documentElement.classList.toggle('dark', dark); localStorage.setItem('theme', dark ? 'dark' : 'light')"
                class="hidden rounded-lg p-2 text-gray-500 hover:bg-gray-100 md:block dark:text-gray-400 dark:hover:bg-gray-700"
                title="{{ __('تبديل الوضع الداكن') }}"
            >
                <svg x-show="!dark" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 15.002A9.72 9.72 0 0118.002 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.598.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009-5.998z" />
                </svg>
                <svg x-show="dark" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                </svg>
            </button>

            {{-- تبديل اللغة: ديسكتوب --}}
            <x-locale-switcher class="hidden rounded-lg px-2.5 py-2 text-gray-500 hover:bg-gray-100 md:flex dark:text-gray-400 dark:hover:bg-gray-700" />

            {{-- user menu: desktop --}}
            <div class="hidden md:block">
                <x-dropdown align="left" width="56">
                    <x-slot name="trigger">
                        <button type="button" class="flex items-center gap-2 rounded-lg py-1.5 ps-1 pe-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-brand-100 text-sm font-semibold text-brand-700 dark:bg-brand-500/20 dark:text-brand-300">
                                {{ mb_substr(auth()->user()->name, 0, 1) }}
                            </span>
                            <span class="max-w-[10rem] truncate text-sm font-medium text-gray-700 dark:text-gray-200">{{ auth()->user()->name }}</span>
                            <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="border-b border-gray-100 px-4 py-2.5 dark:border-gray-700">
                            <p class="truncate text-sm font-semibold text-gray-900 dark:text-gray-100">{{ auth()->user()->name }}</p>
                            <p class="tnum truncate text-xs text-gray-500 dark:text-gray-400" dir="ltr">{{ auth()->user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">{{ __('الملف الشخصي') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-rose-600 transition-colors hover:bg-rose-50 dark:text-rose-400 dark:hover:bg-rose-950">
                                {{ __('تسجيل الخروج') }}
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- menu toggle: mobile --}}
            <button type="button" @click="mobileOpen = !mobileOpen" class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 md:hidden dark:text-gray-400 dark:hover:bg-gray-700">
                <svg x-show="!mobileOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
                <svg x-show="mobileOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- collapsible menu: mobile --}}
    <div x-show="mobileOpen" x-cloak x-transition class="border-t border-gray-200 dark:border-gray-700 md:hidden" style="display:none;">
        <nav class="flex flex-col gap-1 px-4 py-3">
            <a href="{{ route('dashboard') }}" class="nav-link justify-start {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">{{ __('لوحة التحكم') }}</a>
            <a href="{{ route('projects.index') }}" class="nav-link justify-start {{ request()->routeIs('projects.*') ? 'is-active' : '' }}">{{ __('المشاريع') }}</a>
            <a href="{{ route('tasks.index') }}" class="nav-link justify-start {{ request()->routeIs('tasks.*') ? 'is-active' : '' }}">{{ __('كل المهام') }}</a>
            <button
                type="button"
                @click="dark = !dark; document.documentElement.classList.toggle('dark', dark); localStorage.setItem('theme', dark ? 'dark' : 'light')"
                class="nav-link justify-start"
            >
                <span x-show="!dark">🌙 {{ __('الوضع الداكن') }}</span>
                <span x-show="dark" x-cloak style="display:none;">☀️ {{ __('الوضع الفاتح') }}</span>
            </button>
            <x-locale-switcher class="nav-link justify-start" />
        </nav>

        <div class="border-t border-gray-100 px-4 py-3 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-100 text-sm font-semibold text-brand-700 dark:bg-brand-500/20 dark:text-brand-300">
                    {{ mb_substr(auth()->user()->name, 0, 1) }}
                </span>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-gray-900 dark:text-gray-100">{{ auth()->user()->name }}</p>
                    <p class="tnum truncate text-xs text-gray-500 dark:text-gray-400" dir="ltr">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-2">
                <a href="{{ route('profile.edit') }}" class="btn-secondary flex-1 !py-1.5 text-xs">{{ __('الملف الشخصي') }}</a>
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit" class="btn-secondary w-full !py-1.5 text-xs text-rose-600 hover:bg-rose-50 dark:text-rose-400 dark:hover:bg-rose-950">{{ __('تسجيل الخروج') }}</button>
                </form>
            </div>
        </div>
    </div>
</header>
