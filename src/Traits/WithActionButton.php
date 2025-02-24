<?php

namespace Digitlimit\Alert\Traits;

trait WithActionButton
{
    /**
     * Set the action button.
     */
    public function action(string $label, ?string $link = null, array $attributes = []): self
    {
        $this->button('action', $label, $link, $attributes);

        return $this;
    }
}
