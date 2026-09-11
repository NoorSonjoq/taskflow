<x-guest-layout>
    <div class="flex flex-col gap-1.5">
        <span class="page-eyebrow">{{ __('استعادة الحساب') }}</span>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('إعادة تعيين كلمة المرور') }}</h1>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="flex flex-col gap-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input id="email" class="tnum" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('كلمة المرور الجديدة')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <button type="submit" class="btn-primary w-full">{{ __('إعادة تعيين كلمة المرور') }}</button>
    </form>
</x-guest-layout>
