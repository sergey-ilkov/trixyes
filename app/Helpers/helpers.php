<?php

use App\Helpers\Langs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




if (!function_exists('active_link')) {

    function active_link(string $name, string $class = 'active'): string
    {
        return  Route::is("$name*") ? $class : '';
    }
}

if (!function_exists('hasRole')) {

    function hasRole(string $role): bool
    {
        if (Auth::guard('admin')->user()) {

            return Auth::guard('admin')->user()->role === $role;
        }

        return false;
    }
}
if (!function_exists('clearTags')) {

    function clearTags(array $data): array
    {
        foreach ($data as $key => $value) {
            $data[$key] = strip_tags($value);
        }

        return $data;
    }
}

if (!function_exists('alert')) {

    function alert(string $value, string $type = 'success')
    {
        session(['alert' => $value, 'alert_type' => $type]);
    }
}

if (!function_exists('codeGenerator')) {

    function codeGenerator()
    {
        // // $chars = "ABCDEFGHIJKMNOPQRSTUVWXYZ";
        // $chars = "ABCDEFGHIJKMNPQRSTUVWXYZ";
        // // $numbers = '1234567890';
        // $numbers = '123456789';
        // $code = '';
        // for ($i = 0; $i < 3; $i++) {
        //     if ($i > 0) {
        //         $code .= '-';
        //     }
        //     for ($y = 0; $y < 4; $y++) {

        //         $str = rand(0, 1) == 1 ? $chars[rand(0, strlen($chars) - 1)] : $numbers[rand(0, strlen($numbers) - 1)];
        //         $code .= $str;
        //     }
        // }

        $numbers = '1234567890';
        $code = '';

        for ($y = 0; $y < 4; $y++) {

            $code .= $numbers[rand(0, strlen($numbers) - 1)];
        }

        return $code;
    }
}
if (!function_exists('promocodeGenerator')) {

    function promocodeGenerator()
    {
        $chars = "ABCDEFGHIJKMNPQRSTUVWXYZ";
        $numbers = '123456789';
        $code = '';
        for ($i = 0; $i < 3; $i++) {
            if ($i > 0) {
                $code .= '-';
            }
            for ($y = 0; $y < 3; $y++) {

                $str = rand(0, 1) == 1 ? $chars[rand(0, strlen($chars) - 1)] : $numbers[rand(0, strlen($numbers) - 1)];
                $code .= $str;
            }
        }
        return $code;
    }
}

if (!function_exists('getUrlLanguage')) {

    function getUrlLanguage(string $locale)
    {


        // $url = '';
        // $uri = ltrim(str_replace(app()->getLocale(), '', request()->path()), '/');

        $url = '';
        $path = '';
        $pathArr =  explode('/', request()->path());

        if (in_array($pathArr[0], Langs::LOCALES)) {
            $pathArr = array_slice($pathArr, 1);
            $path = implode('/', $pathArr);
        } else if ($pathArr[0] !== '') {
            $path = implode('/', $pathArr);
        }

        if ($locale == 'uk') {
            $url = url('/') . '/' . $path;
        } else {
            if ($path) {

                $url = url('/') . '/' .  $locale . '/' . $path;
            } else {

                $url = url('/') . '/' .  $locale;
            }
        }


        // if ($locale == env('APP_LOCALE')) {
        //     if ($uri) {

        //         $url = url('/') . '/' . $uri;
        //     } else {

        //         $url = url('/') .  $uri;
        //     }
        //     // $url = url('/') .  $uri;
        // } else {
        //     if ($uri) {
        //         $url = url('/') . '/' .  $locale . '/' .  $uri;
        //     } else {
        //         $url = url('/') . '/' .  $locale .   $uri;
        //     }
        //     // $url = url('/') . '/' .  $locale .   $uri;
        // }


        return $url;
    }

    // function getUrlLanguage(string $locale)
    // {

    //     $url = '';
    //     $path = '';

    //     $pathArr =  explode('/', Request::path());


    //     if (in_array($pathArr[0], config('app.available_locales'))) {
    //         $pathArr = array_slice($pathArr, 1);
    //         $path = implode('/', $pathArr);
    //     } else if ($pathArr[0] !== '') {
    //         $path = implode('/', $pathArr);
    //     }

    //     if ($locale == 'uk') {
    //         $url = url('/') . '/' . $path;
    //     } else {
    //         $url = url('/') . '/' .  $locale . '/' . $path;
    //     }



    //     return $url;
    // }
}