<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //Force SSL when not in local development
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Infrastructure & Scheduling',
                'Booking & Client Interaction',
                'Blog',
            ]);
        });

        if (request()->routeIs('blog.*')) {
            Paginator::useBootstrapFive();
        }
    }
}
