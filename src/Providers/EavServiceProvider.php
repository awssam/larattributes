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
        $this->publishesConfig('awssam/larattributes');
        $this->registerConfig();
        ! $this->autoloadMigrations('awssam/larattributes') || $this->loadMigrationsFrom(__DIR__.'/../../Database/Migrations');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/config.php'), 'larattributes');
         Builder::macro('withAttributes', function ($args = false) { return EavQueryBuilder::withAttributes($this,$args);});
    }





}
