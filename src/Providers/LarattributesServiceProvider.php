<?php

namespace Larattributes\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;
use Larattributes\Concerns\EavQueryBuilder;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

class LarattributesServiceProvider extends ServiceProvider
{


    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('larattributes.php')], 'larattributes');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('larattributes');
        }
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'larattributes');
         Builder::macro('withAttributes', function ($args = false) { return EavQueryBuilder::withAttributes($this,$args);});
    }


    /**
     * Set the config path
     *
     * @return string
     */
    protected function configPath()
    {
        return __DIR__ . '/../../config/larattributes.php';
    }

}
