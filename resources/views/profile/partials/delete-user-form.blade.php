<section class="flex flex-col gap-4">
    <header>
        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
            {{ __('حذف الحساب') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            {{ __('بعد حذف حسابك، رح تنحذف كل بياناته نهائياً. حمّل أي بيانات بدك تحتفظ فيها قبل ما تحذف حسابك.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('حذف الحساب') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                {{ __('متأكد إنك بدك تحذف حسابك؟') }}
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                {{ __('بعد حذف حسابك، رح تنحذف كل بياناته نهائياً. أدخل كلمة المرور للتأكيد.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('كلمة المرور') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="w-3/4"
                    placeholder="{{ __('كلمة المرور') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('إلغاء') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('حذف الحساب') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
