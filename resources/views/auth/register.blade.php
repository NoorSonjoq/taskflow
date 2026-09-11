<x-guest-layout>
    <div class="flex flex-col gap-1.5">
        <span class="page-eyebrow">{{ __('ابدأ الآن') }}</span>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('إنشاء حساب') }}</h1>
    </div>

    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('الاسم')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')"
                          placeholder="{{ __('الاسم الكامل') }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input id="email" class="tnum" type="email" name="email" :value="old('email')"
                          placeholder="name@example.com" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('كلمة المرور')" />
            <x-text-input id="password" type="password" name="password"
                          placeholder="{{ __('٨ أحرف على الأقل') }}" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                          placeholder="••••••••" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <button type="submit" class="btn-primary w-full">{{ __('إنشاء الحساب') }}</button>
    </form>

    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('عندك حساب؟') }} <a href="{{ route('login') }}" class="font-medium text-brand-600 hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300">{{ __('سجّل الدخول') }}</a></p>
</x-guest-layout>
