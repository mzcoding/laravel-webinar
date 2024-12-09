<?php

declare(strict_types=1);

namespace App\Providers;

use App\Resolvers\CrudResolver;
use App\Services\Contracts\CrmIntegrationInterface;
use App\Services\Contracts\CrudInterface;
use App\Services\PageService;
use App\Services\UserCrmIntegration;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(CrudInterface::class,
            fn () => new CrudResolver(new UserCrmIntegration((bool) config('app.debug')))
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
