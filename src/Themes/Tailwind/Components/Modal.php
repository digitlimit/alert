<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Digitlimit\Alert\Helpers\Attribute;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Class Modal
 */
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
     * Merge and convert array attributes to HTML string attributes.
     */
    public function actionAttributes(array $attributes = []): string
    {
        $buttonAttributes = config('alert.tailwind.attributes.buttons.action');
        $buttonAttributes['class'] = 'modal-action-button';

        $newAttributes = array_merge(
            $buttonAttributes,
            $attributes
        );

        return Attribute::toString($newAttributes);
    }

    /**
     * Merge and convert array attributes to HTML string attributes.
     */
    public function cancelAttributes(array $attributes = []): string
    {
        $buttonAttributes = config('alert.tailwind.attributes.buttons.cancel');
        $buttonAttributes['class'] = 'modal-cancel-button';

        $newAttributes = array_merge(
            $buttonAttributes,
            $attributes
        );

        return Attribute::toString($newAttributes);
    }

    /**
     * Merge and convert array attributes to HTML string attributes.
     */
    public function actionLinkAttributes(array $attributes = []): string
    {
//        $button = config('alert.tailwind.classes.buttons.primary');
        $linkAttributes = config('alert.tailwind.attributes.links.action');
        $linkAttributes['class'] = 'modal-action-button';

        $newAttributes = array_merge(
            $linkAttributes,
            $attributes
        );

        return Attribute::toString($newAttributes);
    }

    /**
     * Merge and convert array attributes to HTML string attributes.
     */
    public function cancelLinkAttributes(array $attributes = []): string
    {
//        $button = config('alert.tailwind.classes.buttons.secondary');
        $linkAttributes = config('alert.tailwind.attributes.links.cancel');
        $linkAttributes['class'] = 'modal-cancel-button';;

        $newAttributes = array_merge(
            $linkAttributes,
            $attributes
        );

        return Attribute::toString($newAttributes);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::themes.tailwind.components.modal');
    }

}
