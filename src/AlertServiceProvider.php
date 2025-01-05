<?php

namespace Digitlimit\Alert;

use Digitlimit\Alert\Helpers\Theme;
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

        $this->registerComponents();

        $this->registerMacros();

        $this->bootForConsole();
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->app->bind(SessionInterface::class, Session::class);
        $this->app->bind(ConfigInterface::class, Config::class);

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
     * Register alert components.
     *
     * @throws Exception
     */
    protected function registerComponents(): void
    {
        $theme = Theme::theme();

        if (empty($theme)) {
            throw new Exception('Invalid alert theme configuration');
        }

        Blade::componentNamespace($theme['components'], 'alert');

        foreach ($theme['types'] as $type) {
            Blade::component($type['view'], $type['component']);
        }
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
