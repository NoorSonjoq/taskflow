<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    // تبديل لغة الواجهة (عربي/إنجليزي) والرجوع لنفس الصفحة
    public function update(Request $request, string $locale)
    {
        abort_unless(in_array($locale, SetLocale::SUPPORTED_LOCALES, true), 404);

        $request->session()->put('locale', $locale);

        return back();
    }
}
