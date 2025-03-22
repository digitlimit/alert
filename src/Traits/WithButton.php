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
                $button['label'] ?? null,
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
