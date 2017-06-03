<?php namespace Digitlimit\Alert;

use Illuminate\Support\ServiceProvider;

class AlertServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app['alert'] = $this->ap->singleton(function($app)
        {
            return new Alert($app['session.store']);
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'alert');

        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/alert')
        ]);

    }

}