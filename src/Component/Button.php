<?php

namespace Digitlimit\Alert\Component;

/**
 * The button component.
 */
class Button
{
    /**
     * The button id.
     */
    protected string $id;

    /**
     * Create a new button instance.
     *
     * @return void
     */
    public function __construct(
        protected string $name,
        protected string $label,
        protected ?string $link = null,
        protected array $attributes = []
    ) {
        $this->id = uniqid();
    }

    public function id(string $id): self
    {
        $this->attributes['id'] = $id;
        $this->id = $id;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

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

    /**
     * Get the button name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the button attributes.
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Get the button link.
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * Get the button label.
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Check if button is link button.
     */
    public function isLink(): bool
    {
        return ! empty($this->link);
    }

    /**
     * Check if button is action button.
     */
    public function isAction(): bool
    {
        return $this->getName() === 'action';
    }

    /**
     * Check if button is cancel button.
     */
    public function isCancel(): bool
    {
        return $this->getName() === 'cancel';
    }

    /**
     * Convert the button instance to an array.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
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
            $button['id'],
            $button['name'],
            $button['label'],
            $button['link'],
            $button['attributes']
        );
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
