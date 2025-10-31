<?php

namespace App\Providers;

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

        echo "RQWE";
        
        // Share transformations data with welcome view
        view()->composer('welcome', function ($view) {
            $view->with('transformations', config('transformations.items'));
        });

        // Optimize Livewire for faster loading
        if ($this->app->environment('production')) {
            \Livewire\Livewire::setUpdateRoute(function ($handle) {
                return \Illuminate\Support\Facades\Route::post('/livewire/update', $handle)
                    ->middleware(['web']);
            });
        }

        // Enable response caching
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\View::share('cacheVersion', config('app.asset_version', '1.0'));
        }
    }
}
