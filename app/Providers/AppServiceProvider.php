<?php

namespace App\Providers;

use App\Models\application_setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $this->app->booted(function () {
            $appTitle = application_setting::where('setting_key', 'app_tittle')->value('setting_value');

            view()->share('appTitle', $appTitle);
        });
    }
}
