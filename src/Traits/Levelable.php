<?php

namespace Digitlimit\Alert\Traits;

trait Levelable
{
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
        $this->level = 'danger';

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
}
