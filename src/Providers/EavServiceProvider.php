<?php

namespace Larattributes\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;
use Larattributes\Concerns\EavQueryBuilder;


class EavServiceProvider extends ServiceProvider
{


    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $basePath = $this->app->basePath('vendor/'.'awssam/larattributes');

        if (file_exists($path = $basePath.'/Config/config.php')) {
            $this->publishes([$path => $this->app->configPath(str_replace('/', '.', 'awssam/larattributes').'.php')], 'awssam/larattributes'.'::config');
        }
        ! $this->autoloadMigrations('awssam/larattributes') || $this->loadMigrationsFrom(__DIR__.'/../../Database/Migrations');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../../Config/config.php'), 'larattributes');
         Builder::macro('withAttributes', function ($args = false) { return EavQueryBuilder::withAttributes($this,$args);});
    }



}
