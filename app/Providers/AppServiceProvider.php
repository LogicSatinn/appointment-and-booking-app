<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
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
    }
}
