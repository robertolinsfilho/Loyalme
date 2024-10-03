<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PartnerSellsRepository;
use App\Interfaces\PartnerSellsRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PartnerSellsRepositoryInterface::class,PartnerSellsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
