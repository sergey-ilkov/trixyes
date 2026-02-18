<?php

namespace App\Helpers;

class Langs
{

    // const LOCALES = ['uk', 'ru'];
    // const LOCALES = ['uk'];
    const LOCALES = ['es'];

    public static function getLocale(): string
    {
        $locale = request()->segment(1, '');
        // if ($locale) {
        //     if (in_array($locale, self::LOCALES)) {
        //         return $locale;
        //     }
        // }
        if ($locale && $locale !== env('APP_LOCALE')) {
            if (in_array($locale, self::LOCALES)) {
                return $locale;
            }
        }

        return '';
    }
}
