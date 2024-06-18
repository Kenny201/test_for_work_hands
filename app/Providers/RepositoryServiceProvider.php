<?php

namespace App\Providers;

use App\Interfaces\AdvertisementRepositoryInterface;
use App\Repositories\AdvertisementRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AdvertisementRepositoryInterface::class,AdvertisementRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
