<?php

namespace Digitlimit\Alert\Themes\Tailwind;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Digitlimit\Alert\Helpers\Attribute;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component implements LivewireInterface
{
    /**
     * The default alert tag.
     */
    public string $defaultTag = Alert::DEFAULT_TAG;

    /**
     * The alert tag.
     */
    public string $tag;

    /**
     * The alert
     */
    public array $data = [];

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
    public array $actionLinkAttributes = [
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900',
        '@click' => 'modalOpen = false;',
    ];

    /**
     * Default cancel button attributes.
     */
    public array $cancelLinkAttributes = [
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2',
        '@click' => 'modalOpen = false;',
    ];

    /**
     * @throws Exception
     */
    public function mount(): void
    {
        $this->tag = $this->tag ?? $this->defaultTag;
        $this->data = Alert::taggedModal($this->tag)?->toArray() ?? [];

        if (empty($this->data)) {
            $this->skipRender();
        }
    }

    #[On('refresh-alert-modal')]
    public function refresh(string $tag, array $data): void
    {
        if ($this->tag !== $tag) {
            return;
        }

        $this->data = $data;
        $this->dispatch('open-alert-modal');
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
    public function actionAttributes(array $attributes = []): string
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
    public function cancelAttributes(array $attributes = []): string
    {
        $newAttributes = array_merge(
            $this->cancelAttributes,
            $attributes
        );

        return Attribute::toString($newAttributes);
    }

    /**
     * Merge and convert array attributes to HTML string attributes.
     */
    public function actionLinkAttributes(array $attributes = []): string
    {
        $newAttributes = array_merge(
            $this->actionLinkAttributes,
            $attributes
        );

        return Attribute::toString($newAttributes);
    }

    /**
     * Merge and convert array attributes to HTML string attributes.
     */
    public function cancelLinkAttributes(array $attributes = []): string
    {
        $newAttributes = array_merge(
            $this->cancelLinkAttributes,
            $attributes
        );

        return Attribute::toString($newAttributes);
    }
}
