<x-guest-layout>
    <div class="flex flex-col gap-1.5">
        <span class="page-eyebrow">{{ __('خطوة أخيرة') }}</span>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('تأكيد البريد الإلكتروني') }}</h1>
    </div>

    <p class="text-sm text-gray-600 dark:text-gray-400">
        {{ __('شكراً على تسجيلك! قبل ما تبدأ، بنحب نتأكد من بريدك الإلكتروني عن طريق الرابط يلي أرسلناه إلك. ما وصلك؟ منقدر نرسله من جديد.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="rounded-lg bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
            {{ __('تم إرسال رابط تأكيد جديد لبريدك الإلكتروني.') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary">{{ __('إعادة إرسال رابط التأكيد') }}</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm font-medium text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                {{ __('تسجيل الخروج') }}
            </button>
        </form>
    </div>
</x-guest-layout>
