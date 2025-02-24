<?php

namespace Digitlimit\Alert\Contracts;

interface HasButton
{
    /**
     * Add a button to the alert.
     */
    public function button(string $name, string $label, ?string $link = null, array $attributes = []): self;

    /**
     * Add multiple buttons to the alert.
     */
    public function buttons(array $buttons): self;

    /**
     * Get the buttons for the alert.
     */
    public function getButtons(): array;
}
