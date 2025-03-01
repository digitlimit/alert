<?php

namespace Digitlimit\Alert\Traits;

/**
 * WithActionButton trait.
 */
trait WithCancelButton
{
    /**
     * Set the cancel button.
     */
    public function cancel(string $label, ?string $link = null, array $attributes = []): self
    {
        $this->button('cancel', $label, $link, $attributes);

        return $this;
    }
}
