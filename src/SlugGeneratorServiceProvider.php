<?php

namespace Afzalsabbir\SlugGenerator;

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
        $this->mergeConfigFrom(__DIR__ . '/../config/slug-generator.php', 'sluggenerator');

        $this->publishConfig();
        //$this->publishTraits();

        // $this->loadViewsFrom(__DIR__.'/resources/views', 'slug-generator');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->registerRoutes();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
    }

    /**
     * Get route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace'  => "Afzalsabbir\SlugGenerator\Http\Controllers",
            'middleware' => 'api',
            'prefix'     => 'api'
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register facade
        $this->app->singleton('slug-generator', function () {
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
                __DIR__ . '/../config/slug-generator.php' => config_path('sluggenerator.php'),
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
