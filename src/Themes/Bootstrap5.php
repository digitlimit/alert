<?php

namespace Digitlimit\Alert\Themes;

use Digitlimit\Alert\Contracts\ThemeInterface;
use Illuminate\Support\Facades\Blade;

class Bootstrap5 extends AbstractTheme implements ThemeInterface
{
    /**
     * Register the alert components
     */
    public function boot(): void
    {
        $this->registerComponents();

        $this->listeners();
    }

    /**
     *  Register the alert types
     */
    public function types(): array
    {
        return config('alert.bootstrap5.types');
    }

    public function registerComponents(): void
    {
        $types = $this->types();

        Blade::componentNamespace(__NAMESPACE__, 'alert');

        foreach($types as $type) {
            Blade::component($type['view'], $type['component']);
        }
    }

    public function listeners(): void
    {

    }
}
