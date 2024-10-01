<?php

namespace Digitlimit\Alert\View\Components\Themes\Bootstrap5;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Helpers\Attribute;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
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
     * Default action button attributes.
     */
    public array $actionAttributes = [
        'type'  => 'button',
        'class' => 'btn btn-primary',
    ];

    /**
     * Default cancel button attributes.
     */
    public array $cancelAttributes = [
        'type'            => 'button',
        'class'           => 'btn btn-secondary',
        'data-bs-dismiss' => 'modal',
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
        return view('alert::components.themes.bootstrap5.modal');
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

    /**
     * Merge and convert array attributes to HTML string attributes.
     */
    public function cancelAttributes(array $attributes): string
    {
        $newAttributes = array_merge(
            $this->cancelAttributes,
            $attributes
        );

        return Attribute::toString($newAttributes);
    }
}
