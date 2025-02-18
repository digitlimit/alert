<?php

namespace Digitlimit\Alert\View\Components\Themes\Tailwind;

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
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900',
        '@click' => 'modalOpen = false;',
    ];

    /**
     * Default cancel button attributes.
     */
    public array $cancelAttributes = [
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2',
        '@click' => 'modalOpen = false;',
    ];

    /**
     * Default action button attributes.
     */
    public array $linkActionAttributes = [
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900',
        '@click' => 'modalOpen = false;',
    ];

    /**
     * Default cancel button attributes.
     */
    public array $linkCancelAttributes = [
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2',
        '@click' => 'modalOpen = false;',
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
        return view('alert::components.themes.tailwind.modal');
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
