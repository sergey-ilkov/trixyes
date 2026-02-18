<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Interface\Admin\PostAdminInterface;
use Illuminate\Support\Facades\RateLimiter;
use App\Interface\Admin\ActionAdminInterface;
use App\Interface\Admin\ReviewAdminInterface;
use App\Interface\Admin\ServiceAdminInterface;
use App\Repositories\Admin\PostAdminRepository;
use App\Repositories\Admin\ActionAdminRepository;
use App\Repositories\Admin\ReviewAdminRepository;
use App\Repositories\Admin\ServiceAdminRepository;
use App\Interface\Admin\ServiceCategoryAdminInterface;
use App\Repositories\Admin\ServiceCategoryAdminRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(PostAdminInterface::class, PostAdminRepository::class);
        $this->app->bind(ReviewAdminInterface::class, ReviewAdminRepository::class);
        $this->app->bind(ServiceCategoryAdminInterface::class, ServiceCategoryAdminRepository::class);
        $this->app->bind(ActionAdminInterface::class, ActionAdminRepository::class);
        $this->app->bind(ServiceAdminInterface::class, ServiceAdminRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Paginator::useBootstrapFive();


        RateLimiter::for('user-auth', function (Request $request) {
            return Limit::perMinute(env('LIMIT_AUTH_REQUEST', 10))->by($request->user()?->id ?: $request->ip());
        });


        // ? Preventing Lazy Loading
        Model::preventLazyLoading(! $this->app->isProduction());
    }
}