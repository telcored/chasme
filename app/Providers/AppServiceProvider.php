<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        if (config('app.env') !== 'local') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        Paginator::useBootstrapFive();

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $view->with('settings', \App\Models\Setting::all()->pluck('value', 'key')->toArray());
            }
        });

        Blade::if('permission', function ($permissions) {
            $user = auth()->user();
            if (! $user) {
                return false;
            }

            return $user->hasPermission($permissions);
        });
    }
}
