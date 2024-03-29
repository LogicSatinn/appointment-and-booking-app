<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {}

    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerTheme(
                app(Vite::class)('resources/css/filament.css'),
            );

            Filament::registerNavigationGroups([
                'Infrastructure & Scheduling',
                'Booking & Client Interaction',
                'Blog',
            ]);
        });
    }
}
