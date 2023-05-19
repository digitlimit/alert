<?php

namespace Digitlimit\Alert\Component;

class Button
{
    /**
     * Create a new button instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $label = null,
        public ?string $link = null,
        public array $attributes = []
    ) {
    }

    /**
     * Set the button label.
     */
    public function label(string $label): void
    {
        $this->label = $label;
    }

    /**
     * Set the button link.
     */
    public function link(string $link): void
    {
        $this->link = $link;
    }

    /**
     * Set the button attributes.
     */
    public function attributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }
}
