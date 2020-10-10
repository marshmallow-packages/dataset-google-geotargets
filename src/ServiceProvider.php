<?php

namespace Marshmallow\Datasets\GoogleGeoTargets;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/google-geotargets.php',
            'google-geotargets'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/google-geotargets.php' => config_path('google-geotargets.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
