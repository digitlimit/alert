<?php
namespace Digitlimit\Alert;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

use Digitlimit\View\Components;

class AlertServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'alert');

        $this->registerComponents();
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->app->singleton('alert', function ($app) {
            $store = new AlertStore($app['session.store']);
            return new Alert(new Alerter($store));
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides() : array
    {
        return ['alert'];
    }

    /**
     * Console-specific booting.
     */
    protected function bootForConsole(): void
    {
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/digitlimit'),
        ], 'alert.views');
    }

    /**
     * Register alert components
     */
    protected function registerComponents() : void
    {
        Blade::componentNamespace('Digitlimit\\Views\\Components', 'alert');

        Blade::component('alert-bar',    Components\Bar::class);
        Blade::component('alert-field',  Components\Field::class);
        Blade::component('alert-modal',  Components\Modal::class);
        Blade::component('alert-notify', Components\Notify::class);
        Blade::component('alert-sticky', Components\Sticky::class);
    }
}