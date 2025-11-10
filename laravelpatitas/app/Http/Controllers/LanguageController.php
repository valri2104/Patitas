<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    private const ALLOWED_LOCALES = ['es', 'en'];

    public function change(string $locale): RedirectResponse
    {
        if (! in_array($locale, self::ALLOWED_LOCALES, true)) {
            $locale = Config::get('app.locale');
        }

        Session::put('locale', $locale);
        App::setLocale($locale);

        return redirect()->back();
    }
}
