<?php

namespace Digitlimit\Alert;

use Digitlimit\Alert\Helpers\Theme;
use Exception;
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

        $this->bootAlert();

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
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return ['alert'];
    }

    /**
     * Boot the alert.
     *
     * @throws Exception
     */
    protected function bootAlert(): void
    {
        Theme::theme()->boot();
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
        Alert::macro('stickForget', function (?string $tag = null) {
            app(Alert::class)
                ->sticky()
                ->forget($tag);
        });
    }
}
