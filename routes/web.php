<?php

use App\Helpers\Langs;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\Auth\AuthUserController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\TestController;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;





Route::prefix(Langs::getLocale())->middleware('langs')->group(function () {
    // ? all routes
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::post('/services', [ServiceController::class, 'services'])->name('services.get');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('article');


    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    // Route::post('/contacts', [ContactController::class, 'send'])->name('contacts.send');



    // ? forgot password 
    // Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot.password');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password');

    Route::middleware(['throttle:user-auth'])->group(function () {
        Route::post('/contacts', [ContactController::class, 'send'])->name('contacts.send');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgotPasswordForm'])->name('forgot.password.post');
        Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    });
});





// ? auth users  ограничение 10 запросов в 1 минуту. настраивается в .env 'LIMIT_AUTH_REQUEST' AppServiceProvider
Route::middleware(['throttle:user-auth'])->group(function () {
    Route::post('/register', [AuthUserController::class, 'register'])->name('user.register');
    Route::post('/login', [AuthUserController::class, 'login'])->name('user.login');
});



Route::middleware('auth:web')->group(function () {
    Route::get('/logout', [AuthUserController::class, 'logout'])->name('user.logout');
});


// ? test
// Route::get('/test', [TestController::class, 'index'])->name('test');