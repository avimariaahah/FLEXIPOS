<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\Service\SpoilageServiceInterface;
use App\Services\SpoilageService;
use App\Interface\Service\SpoilageDetailServiceInterface;
use App\Services\SpoilageDetailService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvider::class);

        $this->app->bind(SpoilageServiceInterface::class, SpoilageService::class);
        $this->app->bind(SpoilageDetailServiceInterface::class, SpoilageDetailService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(base_path('routes/spoilageRoutes.php'));

    }
}
