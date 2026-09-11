<x-guest-layout>
    <div class="flex flex-col gap-1.5">
        <span class="page-eyebrow">{{ __('استعادة الحساب') }}</span>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('نسيت كلمة المرور؟') }}</h1>
    </div>

    <p class="text-sm text-gray-600 dark:text-gray-400">
        {{ __('لا مشكلة. أدخل بريدك الإلكتروني وبنرسلك رابط لإعادة تعيين كلمة المرور.') }}
    </p>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input id="email" class="tnum" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <button type="submit" class="btn-primary w-full">{{ __('إرسال رابط إعادة التعيين') }}</button>
    </form>
</x-guest-layout>
