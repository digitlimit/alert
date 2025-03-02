<?php

namespace Digitlimit\Alert\Themes\Tailwind;

use Digitlimit\Alert\Helpers\Theme;
use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class TailwindServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @throws Exception
     */
    public function boot(): void
    {
        Tailwind::registerComponents();

        Tailwind::dehydrate();

        $this->bootForConsole();
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->app->singleton('alert-theme', function ($app) {
            return Theme::theme();
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return ['alert-theme'];
    }

    /**
     * Console-specific booting.
     */
    protected function bootForConsole(): void
    {
        // Define publishable SCSS assets
        $this->publishes([
            realpath(__DIR__.'/../../../../resources/scss/themes/tailwind') => resource_path('scss/alert'),
        ], 'alert-scss');

        // Define publishable compiled CSS
        $this->publishes([
            realpath(__DIR__.'/../../../../resources/css/themes/tailwind/alerts.css') => public_path('vendor/alert/alerts.css'),
        ], 'alert-css');
    }

    /**
     * Register directives
     */
    public function registerDirectives(): void
    {
        Blade::directive('alertStyles', function () {
            return '<link rel="stylesheet" href="' . asset('vendor/alert/alert.css') . '">';
        });
    }
}
