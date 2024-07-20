<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;
use Spatie\Color\Color;

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
        FilamentColor::register([
            'primary' => '#e7e5e4',
        ]);
   
    }
}
