<?php

namespace AfzalSabbir\SlugGenerator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class SlugGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sluggenerator.php', 'sluggenerator');

        $this->publishConfig();
        //$this->publishTraits();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register facade
        $this->app->singleton('sluggenerator', function () {
            return new SlugGenerator;
        });
    }

    /**
     * Publish Config
     *
     * @return void
     */
    public function publishConfig()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sluggenerator.php' => config_path('sluggenerator.php'),
            ], 'config');
        }
    }

    /**
     * Publish Trails
     * @return void
     */
    public function publishTraits()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/Traits/SlugGenerator.php' => app_path('Traits/SlugGenerator.php'),
            ], 'traits');
        }
    }
}
