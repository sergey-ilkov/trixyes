<?php


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Controllers\Admin\SitemapController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\ActionAdminController;
use App\Http\Controllers\Admin\ReviewAdminController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\Auth\AuthAdminController;
use App\Http\Controllers\Admin\Auth\UserAdminController;
use App\Http\Controllers\Admin\ServiceCategoryAdminController;




Route::middleware('guest:admin')->group(function () {

    Route::post('/authenticate', [AuthAdminController::class, 'authenticate'])->name('admin.authenticate');
});



Route::get('/login', [AuthAdminController::class, 'login'])->name('admin.login');


Route::middleware('auth:admin')->group(function () {

    Route::get('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
    Route::get('/', [HomeAdminController::class, 'index'])->name('admin.home');


    // ? languages
    Route::get('/languages', [LanguageController::class, 'index'])->name('admin.languages.index');
    Route::get('/languages/create', [LanguageController::class, 'create'])->name('admin.languages.create');
    Route::post('/languages', [LanguageController::class, 'store'])->name('admin.languages.store');
    Route::get('/languages/{id}/edit', [LanguageController::class, 'edit'])->name('admin.languages.edit');
    Route::put('/languages/{id}', [LanguageController::class, 'update'])->name('admin.languages.update');


    // ? posts
    Route::get('/posts', [PostAdminController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/create', [PostAdminController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [PostAdminController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/{id}', [PostAdminController::class, 'show'])->name('admin.posts.show');
    Route::get('/posts/{id}/edit', [PostAdminController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{id}', [PostAdminController::class, 'update'])->name('admin.posts.update');
    Route::delete('/posts/{id}', [PostAdminController::class, 'destroy'])->name('admin.posts.destroy');

    // ? reviews
    Route::get('/reviews', [ReviewAdminController::class, 'index'])->name('admin.reviews.index');
    Route::get('/reviews/create', [ReviewAdminController::class, 'create'])->name('admin.reviews.create');
    Route::post('/reviews', [ReviewAdminController::class, 'store'])->name('admin.reviews.store');
    Route::get('/reviews/{id}/edit', [ReviewAdminController::class, 'edit'])->name('admin.reviews.edit');
    Route::put('/reviews/{id}', [ReviewAdminController::class, 'update'])->name('admin.reviews.update');
    Route::delete('/reviews/{id}', [ReviewAdminController::class, 'destroy'])->name('admin.reviews.destroy');

    // ? services
    Route::get('/services', [ServiceAdminController::class, 'index'])->name('admin.services.index');
    Route::get('/services/create', [ServiceAdminController::class, 'create'])->name('admin.services.create');
    Route::post('/services', [ServiceAdminController::class, 'store'])->name('admin.services.store');
    Route::get('/services/{id}/edit', [ServiceAdminController::class, 'edit'])->name('admin.services.edit');
    Route::put('/services/{id}', [ServiceAdminController::class, 'update'])->name('admin.services.update');
    // Route::delete('/services/{id}', [ServiceAdminController::class, 'destroy'])->name('admin.services.destroy');


    // ? sitemap
    Route::get('/sitemap', [SitemapController::class, 'index'])->name('admin.sitemap.index');
    Route::get('/sitemap/create', [SitemapController::class, 'createSitemap'])->name('admin.sitemap.create');
});



// ? role superadmin

Route::middleware('auth:admin', SuperAdminMiddleware::class)->group(function () {

    // ? administrators
    Route::get('/administrators', [UserAdminController::class, 'index'])->name('administrators.index');
    Route::get('/administrators/create', [UserAdminController::class, 'create'])->name('administrators.create');
    Route::post('/administrators', [UserAdminController::class, 'store'])->name('administrators.store');
    Route::get('/administrators/{id}/edit', [UserAdminController::class, 'edit'])->name('administrators.edit');
    Route::put('/administrators/{id}', [UserAdminController::class, 'update'])->name('administrators.update');
    Route::delete('/administrators/{id}', [UserAdminController::class, 'destroy'])->name('administrators.destroy');

    // ? service categories
    Route::get('/service-categories', [ServiceCategoryAdminController::class, 'index'])->name('admin.service-categories.index');
    Route::get('/service-categories/create', [ServiceCategoryAdminController::class, 'create'])->name('admin.service-categories.create');
    Route::post('/service-categories', [ServiceCategoryAdminController::class, 'store'])->name('admin.service-categories.store');
    Route::get('/service-categories/{id}/edit', [ServiceCategoryAdminController::class, 'edit'])->name('admin.service-categories.edit');
    Route::put('/service-categories/{id}', [ServiceCategoryAdminController::class, 'update'])->name('admin.service-categories.update');

    // ? actions
    Route::get('/actions', [ActionAdminController::class, 'index'])->name('admin.actions.index');
    Route::get('/actions/create', [ActionAdminController::class, 'create'])->name('admin.actions.create');
    Route::post('/actions', [ActionAdminController::class, 'store'])->name('admin.actions.store');
    Route::get('/actions/{id}/edit', [ActionAdminController::class, 'edit'])->name('admin.actions.edit');
    Route::put('/actions/{id}', [ActionAdminController::class, 'update'])->name('admin.actions.update');
});