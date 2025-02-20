<?php

namespace Digitlimit\Alert;

use Digitlimit\Alert\Contracts\ConfigInterface;
use Digitlimit\Alert\Contracts\SessionInterface;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Helpers\Theme;
use Exception;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;
use Livewire\Livewire;
use function Livewire\on;
use function Livewire\store;

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
     * Boot the alert.
     * @throws Exception
     */
    protected function bootAlert(): void
    {
        Theme::theme()->boot();

        on('dehydrate', function (Component $component) {
            if (! Livewire::isLivewireRequest()) {
                return;
            }

            if (store($component)->has('redirect')) {
                return;
            }

            if (count(session()->get(SessionKey::mainKey()) ?? []) <= 0) {
                return;
            }

            info('dehydrate', ['component' => $component]);

            $component->dispatch('showModal');
        });

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
