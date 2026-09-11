<x-guest-layout>
    <div class="flex flex-col gap-1.5">
        <span class="page-eyebrow">{{ __('أهلاً بعودتك') }}</span>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('تسجيل الدخول') }}</h1>
    </div>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input id="email" class="tnum" type="email" name="email" :value="old('email')"
                          placeholder="name@example.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('كلمة المرور')" />
            <x-text-input id="password" type="password" name="password"
                          placeholder="••••••••" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                {{ __('تذكّرني') }}
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-brand-600 hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300">{{ __('نسيت كلمة المرور؟') }}</a>
            @endif
        </div>

        <button type="submit" class="btn-primary w-full">{{ __('دخول') }}</button>
    </form>

    <div class="flex items-center gap-3 text-xs text-gray-400">
        <span class="h-px flex-1 bg-gray-200"></span>
        {{ __('أو سجّل الدخول عبر') }}
        <span class="h-px flex-1 bg-gray-200"></span>
    </div>

    <div class="grid grid-cols-2 gap-3">
        <a href="{{ route('social.redirect', 'github') }}" class="btn-secondary">GitHub</a>
        <a href="{{ route('social.redirect', 'google') }}" class="btn-secondary">Google</a>
    </div>

    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('ما عندك حساب؟') }} <a href="{{ route('register') }}" class="font-medium text-brand-600 hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300">{{ __('أنشئ حساب جديد') }}</a></p>
</x-guest-layout>
