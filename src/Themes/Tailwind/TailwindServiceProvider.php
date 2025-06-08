<?php

namespace Digitlimit\Alert\Themes\Tailwind;

use Digitlimit\Alert\Helpers\Theme;
use Exception;
use Illuminate\Support\ServiceProvider;

/**
 * Tailwind service provider.
 */
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
}
