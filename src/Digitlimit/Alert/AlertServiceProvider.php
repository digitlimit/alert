<?php
namespace Digitlimit\Alert;

use Illuminate\Support\ServiceProvider;

class AlertServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'digitlimit');
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'digitlimit');

        // Publishing is only necessary when using the CLI.
        // if ($this->app->runningInConsole()) {
        //     $this->bootForConsole();
        // }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        // $this->app->singleton('alert', function ($app) {
        //     return new Alert($app['session.store']);
        // });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['alert'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // $this->publishes([
        //     __DIR__.'/../migrations' => database_path('migrations'),
        // ], 'alert.migrations');

        // $this->publishes([
        //     __DIR__.'/../seeders' => database_path('seeders'),
        // ], 'alert.seeders');

        // Publishing the configuration file.
        /*$this->publishes([
            __DIR__.'/../config/alert.php' => config_path('alert.php'),
        ], 'alert.config');*/

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/digitlimit'),
        ], 'alert.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/digitlimit'),
        ], 'alert.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/digitlimit'),
        ], 'alert.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}