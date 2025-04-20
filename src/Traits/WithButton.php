<?php

namespace Digitlimit\Alert\Traits;

use Digitlimit\Alert\Component\Button;
use Illuminate\Support\Collection;

trait WithButton
{
    /**
     * The buttons for the alert.
     */
    protected Collection $buttons;

    /**
     * Get the action button.
     */
    public function actionButton(): ?Button
    {
        return $this->getButtons()
            ->filter(fn ($button) => $button->getName() === 'action')
            ->first();
    }

    /**
     * Get the cancel button.
     */
    public function cancelButton(): ?Button
    {
        return $this->getButtons()
            ->filter(fn ($button) => $button->getName() === 'cancel')
            ->first();
    }

    /**
     * Get the custom buttons.
     */
    public function customButtons(): Collection
    {
        return $this->getButtons()
            ->filter(fn ($button) => ! in_array($button->getName(), ['action', 'cancel']));
    }

    /**
     * Determine if the alert has buttons.
     */
    public function hasActionButton(): bool
    {
        return $this->actionButton() !== null;
    }

    /**
     * Determine if the alert has buttons.
     */
    public function hasCancelButton(): bool
    {
        return $this->cancelButton() !== null;
    }

    /**
     * Determine if the alert has custom buttons.
     */
    public function hasCustomButtons(): bool
    {
        return $this->customButtons()->count() > 0;
    }

    /**
     * Add a button to the alert.
     */
    public function button(
        string $name,
        string $label,
        ?string $link = null,
        array $attributes = []
    ): self {
        $button = new Button($name, $label, $link, $attributes);

        if (empty($this->buttons)) {
            $this->buttons = new Collection;
        }

        $this->buttons->push($button);

        return $this;
    }

    /**
     * Add multiple buttons to the alert.
     */
    public function buttons(array $buttons): self
    {
        foreach ($buttons as $button) {
            $this->button(
                $button['name'],
                $button['label'],
                $button['link'] ?? null,
                $button['attributes'] ?? []
            );
        }

        return $this;
    }

    /**
     * Get the buttons for the alert.
     */
    public function getButtons(): Collection
    {
        if (empty($this->buttons)) {
            return new Collection;
        }

        return $this->buttons;
    }

    /**
     * Convert the buttons to an array.
     */
    public function buttonsToArray(): array
    {
        return $this->getButtons()
            ->map(fn ($button) => $button->toArray())
            ->toArray();
    }

    /**
     * Execute a callback and return the instance.
     */
    public function tap(callable $callback)
    {
        $callback($this);

        return $this;
    }
}
