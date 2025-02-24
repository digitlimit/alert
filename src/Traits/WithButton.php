<?php

namespace Digitlimit\Alert\Traits;

use Digitlimit\Alert\Component\Button;

trait WithButton
{
    /**
     * The buttons for the alert.
     */
    protected array $buttons = [];

    /**
     * Add a button to the alert.
     */
    public function button(
        string $name,
        string $label,
        ?string $link = null,
        array $attributes = []
    ): self {
        $this->buttons[] = new Button($name, $label, $link, $attributes);

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
    public function getButtons(): array
    {
        return $this->buttons;
    }
}
