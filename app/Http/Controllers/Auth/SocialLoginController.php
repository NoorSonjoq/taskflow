<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // يحوّل المستخدم لصفحة المزوّد
    public function redirect(string $provider)
    {
        $this->validateProvider($provider);

        return Socialite::driver($provider)->redirect();
    }

    // يرجّع من المزوّد بعد الموافقة
    public function callback(string $provider)
    {
        $this->validateProvider($provider);

        $socialUser = Socialite::driver($provider)->user();

        // نلاقي المستخدم أو ننشئه
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name'        => $socialUser->getName() ?? $socialUser->getNickname(),
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
                'password'    => Str::random(32),
            ]
        );

        Auth::login($user, remember: true);

        return redirect()->route('dashboard');
    }

    private function validateProvider(string $provider): void
    {
        abort_unless(in_array($provider, ['github', 'google']), 404);
    }
}