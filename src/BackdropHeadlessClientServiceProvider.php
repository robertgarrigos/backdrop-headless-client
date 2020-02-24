<?php

namespace Robertgarrigos\BackdropHeadlessClient;

use Illuminate\Support\ServiceProvider;
use Robertgarrigos\BackdropHeadlessClient\BackdropHeadlessClient;

class BackdropHeadlessClientServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    // protected $defer = true;

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'backdrop-headless-client');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'backdrop-headless-client');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('backdrop-headless-client.php'),
            ], 'backdrop-config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/backdrop-headless-client'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/backdrop-headless-client'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/backdrop-headless-client'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {


        // Register the main class to use with the facade
        $this->app->singleton('backdrop', function() {
            return new BackdropHeadlessClient();
        });

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'backdrop-headless-client');
    }
}
