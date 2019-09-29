<?php

namespace Digitlimit\Alert;

use Illuminate\Support\Facades\Blade;
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
        $this->app->singleton('digitlimit.alert', function ($app) {
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
        $this->loadViewsFrom(__DIR__.'/views', 'alert');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/alert'),
        ]);

        Blade::directive('alertHasSuccess', function () {
            return "<?php if(Alert::message() && Alert::status() == 'success'): ?>";
            return '<?php if(Alert::hasSuccess()): ?>';
        });

        Blade::directive('endAlertHasSuccess', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('alertHasNoSuccess', function () {
            return "<?php if(Alert::message() && Alert::status() != 'success'): ?>";
            return '<?php if(!Alert::hasSuccess()): ?>';
        });

        Blade::directive('endAlertHasNoSuccess', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('alertHasError', function () {
            return "<?php if(Alert::message() && Alert::status() == 'error'): ?>";
            return '<?php if(Alert::hasError()): ?>';
        });

        Blade::directive('endAlertHasError', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('alertHasNoError', function () {
            return "<?php if(Alert::message() && Alert::status() != 'error'): ?>";
            return '<?php if(!Alert::hasError()): ?>';
        });

        Blade::directive('endAlertHasNoError', function () {
            return '<?php endif; ?>';
        });
    }
}
