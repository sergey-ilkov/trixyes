<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LangsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = ltrim($request->route()->getPrefix(), '/');

        if ($locale) {
            App::setLocale($locale);
            // return $next($request);
        } else {
            App::setLocale(env('APP_LOCALE'));
        }

        // else {

        //     $uri = $request->path();
        //     dump(['uri ', $uri]);
        //     // return redirect('/uk', 302); // 301
        // }

        // $uri = $request->path();
        // if ($uri === '/') {
        //     return redirect('/uk', 302); // 301 
        // } else {
        //     return abort(404);
        // }
        // ? lang uk redirect flexy.com/uk flexy/com
        // if ($locale === env('APP_LOCALE'))  // uk === uk
        // {
        //     // dump($request->path());
        //     $uri = str_replace($locale, '', $request->path());
        //     // dump($uri);
        //     return redirect($uri, 302); // 301
        // }

        // dump(['middleware ', $locale]);

        return $next($request);
    }
}