<?php
// Modules/Depo/Providers/DepoServiceProvider.php

namespace Modules\Depo\Providers;

use Illuminate\Support\ServiceProvider;

class DepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'depo');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'depo');

        $this->publishes([
            __DIR__ . '/../Resources/views' => resource_path('views/vendor/depo'),
            __DIR__ . '/../Config/config.php' => config_path('depo.php'),
        ]);

        // Register your controllers here
        $this->app->make('Modules\Depo\Http\Controllers\DepoController');

        // Optionally, you may define policy here
        // $this->registerPolicies();
    }
}
