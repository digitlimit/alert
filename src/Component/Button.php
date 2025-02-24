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
        public string $name,
        public ?string $label = null,
        public ?string $link = null,
        public array $attributes = []
    ) {}

    /**
     * Set the button name.
     */
    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set the button label.
     */
    public function label(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Set the button link.
     */
    public function link(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    /**
     * Set the button attributes.
     */
    public function attributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Convert the button instance to an array.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'label' => $this->getLabel(),
            'link' => $this->getLink(),
            'attributes' => $this->getAttributes(),
        ];
    }

    /**
     * Fill the button from an array.
     */
    public static function fill(array $button): self
    {
        return new static(
            $button['name'],
            $button['label'],
            $button['link'],
            $button['attributes']
        );
    }
}
