<?php

namespace Digitlimit\Alert;

use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AlertServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @throws Exception
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'alert');

        Blade::componentNamespace(
            'Digitlimit\\Alert\\Component\\Icons',
            'alert-icon'
        );

        $this->registerMacros();

        $this->bootForConsole();
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->app->singleton('alert', function ($app) {
            return $app->make(Alert::class);
        });

        $this->mergeConfigFrom(__DIR__.'/../config/alert.php', 'alert');

        $this->app->register(Themes\Tailwind\TailwindServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return ['alert'];
    }

    /**
     * Console-specific booting.
     */
    protected function bootForConsole(): void
    {
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/digitlimit/alert'),
        ], 'alert.views');

        $this->publishes([
            __DIR__.'/../config/alert.php' => config_path('alert.php'),
        ], 'alert.config');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/alert'),
        ], 'alert.assets');
    }

    /**
     * Register some helper macros.
     */
    protected function registerMacros(): void
    {
        Alert::macro('forget', function (string $tag = Alert::DEFAULT_TAG) {
            app(Alert::class)
                ->forget($tag);
        });
    }
}