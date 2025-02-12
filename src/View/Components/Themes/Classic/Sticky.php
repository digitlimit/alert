<?php

namespace Digitlimit\Alert\View\Components\Themes\Classic;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Helpers\Attribute;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sticky extends Component
{
    /**
     * Set the default tag.
     */
    public string $defaultTag = Alert::DEFAULT_TAG;

    /**
     * Alert instance.
     */
    public Alert $alert;

    /**
     * Default action button.
     */
    public array $actionAttributes = [
        'type' => 'button',
        'class' => 'btn btn-sm btn-primary float-end',
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::components.themes.classic.sticky');
    }

    /**
     * Merge and convert array attributes to HTML string attributes.
     */
    public function actionAttributes(array $attributes): string
    {
        $newAttributes = array_merge(
            $this->actionAttributes,
            $attributes
        );

        return Attribute::toString($newAttributes);
    }
}
