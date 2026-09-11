<x-guest-layout>
    <div class="flex flex-col gap-1.5">
        <span class="page-eyebrow">{{ __('تأكيد الهوية') }}</span>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('تأكيد كلمة المرور') }}</h1>
    </div>

    <p class="text-sm text-gray-600 dark:text-gray-400">
        {{ __('هاي منطقة محمية بالتطبيق. أدخل كلمة المرور قبل ما تكمل.') }}
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="flex flex-col gap-5">
        @csrf

        <div>
            <x-input-label for="password" :value="__('كلمة المرور')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <button type="submit" class="btn-primary w-full">{{ __('تأكيد') }}</button>
    </form>
</x-guest-layout>
