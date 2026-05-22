<?php

namespace App\Providers;

use App\Models\Realisation;
use App\Observers\RealisationObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Realisation::observe(RealisationObserver::class);

    }
}
