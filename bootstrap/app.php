<?php

use App\Http\Middleware\LangsMiddleware;
use App\Http\Middleware\RedirectTrailingSlash;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix(env('APP_ADMIN_PANEL'))
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        //


        $middleware->redirectGuestsTo('/');


        $middleware->use([RedirectTrailingSlash::class]);

        // ? langs
        $middleware->alias([
            'langs' => LangsMiddleware::class,
        ]);

        // ? csrf token exept route
        // $middleware->validateCsrfTokens(except: [
        //     '/callstream/task' // <-- exclude this route
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //

        $exceptions->respond(function (Response $response) {
            if ($response->getStatusCode() === 419) {
                return response()->json([
                    'message' => __('messages.csrf_token_mismatch')
                ], 419);
            }
            if ($response->getStatusCode() === 429) {
                return response()->json([
                    'message' => __('messages.too_many_attempts')
                ], 429);
            }

            return $response;
        });
    })->create();