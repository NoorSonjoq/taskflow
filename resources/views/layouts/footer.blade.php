<footer class="border-t border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 md:px-10">
        <div class="grid gap-8 md:grid-cols-3">
            <div class="flex flex-col gap-3">
                <div class="flex items-center gap-2.5">
                    <x-application-logo class="h-8 w-8" />
                    <span class="text-lg font-bold text-gray-900 dark:text-white">TaskFlow</span>
                </div>
                <p class="max-w-xs text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                    {{ __('أدِر مشاريعك ومهامك بسهولة، وتابع تقدّمك أولًا بأول.') }}
                </p>
            </div>

            <div class="flex flex-col gap-3">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('روابط سريعة') }}</h3>
                <nav class="flex flex-col gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <a href="{{ route('dashboard') }}" class="w-fit hover:text-brand-600 dark:hover:text-brand-400">{{ __('لوحة التحكم') }}</a>
                    <a href="{{ route('projects.index') }}" class="w-fit hover:text-brand-600 dark:hover:text-brand-400">{{ __('المشاريع') }}</a>
                    <a href="{{ route('tasks.index') }}" class="w-fit hover:text-brand-600 dark:hover:text-brand-400">{{ __('كل المهام') }}</a>
                </nav>
            </div>

            <div class="flex flex-col gap-3">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('تواصل معنا') }}</h3>
                <ul class="flex flex-col gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 shrink-0 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0-.83.67-1.5 1.5-1.5h16.5c.83 0 1.5.67 1.5 1.5v10.5a1.5 1.5 0 0 1-1.5 1.5H3.75a1.5 1.5 0 0 1-1.5-1.5V6.75Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 6 9-6" />
                        </svg>
                        <span class="tnum" dir="ltr">support@taskflow.test</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 shrink-0 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 0 0 2.25-2.25v-1.372a1.5 1.5 0 0 0-1.048-1.43l-3.606-1.16a1.5 1.5 0 0 0-1.588.375l-.848.848a11.25 11.25 0 0 1-5.13-5.13l.848-.848a1.5 1.5 0 0 0 .375-1.588l-1.16-3.606a1.5 1.5 0 0 0-1.43-1.048H4.5a2.25 2.25 0 0 0-2.25 2.25Z" />
                        </svg>
                        <span class="tnum" dir="ltr">+962 79 000 0000</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-100 pt-6 text-center text-xs text-gray-400 dark:border-gray-700 dark:text-gray-500">
            <span class="tnum">&copy; {{ date('Y') }}</span> TaskFlow &mdash; {{ __('جميع الحقوق محفوظة.') }}
        </div>
    </div>
</footer>
