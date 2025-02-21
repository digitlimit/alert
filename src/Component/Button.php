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
    ) {}

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

    /**
     * Convert the button instance to an array.
     */
    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'link' => $this->link,
            'attributes' => $this->attributes,
        ];
    }

    /**
     * Fill the button from an array.
     */
    public static function fill(array $button): self
    {
        return new static(
            $button['label'],
            $button['link'],
            $button['attributes']
        );
    }
}
