<?php

namespace Digitlimit\Alert\Traits;

trait Levelable
{
    /**
     * The level of the alert.
     */
    protected string $level = 'info';

    /**
     * Success alert level.
     */
    public function success(): self
    {
        $this->level = 'success';

        return $this;
    }

    /**
     * Info alert level.
     */
    public function info(): self
    {
        $this->level = 'info';

        return $this;
    }

    /**
     * Error alert level.
     */
    public function error(): self
    {
        $this->level = 'error';

        return $this;
    }

    /**
     * Warning alert level.
     */
    public function warning(): self
    {
        $this->level = 'warning';

        return $this;
    }

    /**
     * Set alert level.
     */
    public function level(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Fetch the alert level.
     */
    public function getLevel(): string
    {
        return $this->level;
    }
}
