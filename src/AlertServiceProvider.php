<?php
namespace Digitlimit\Alert;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AlertServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'alert');

        $this->registerComponents();

        $this->bootForConsole();
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->app->bind(SessionInterface::class, Session::class);

        $this->app->singleton('alert', function ($app) {
            return $app->make(Alert::class);
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/alert.php', 'alert'
        );
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
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/digitlimit/alert'),
        ], 'alert.views');


        $this->publishes([
            __DIR__.'/../config/alert.php' => config_path('alert.php'),
        ], 'alert.config');
    }

    /**
     * Register alert components
     */
    protected function registerComponents() : void
    {
        Blade::componentNamespace('Digitlimit\\Alert\View\\Components', 'alert');

        $types = config('alert.types');

        foreach($types as $name => $type) {
            Blade::component($name,  $type['component']);
        }
    }
}