<?php

namespace Digitlimit\Alert\Traits;

trait Levelable
{
    /**
     * Primary alert level.
     */
    public function primary(): self
    {
        $this->level = 'primary';

        return $this;
    }

    /**
     * Secondary alert level.
     */
    public function secondary(): self
    {
        $this->level = 'secondary';

        return $this;
    }

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

    /**
     * Light alert level.
     */
    public function light(): self
    {
        $this->level = 'light';

        return $this;
    }

    /**
     * Dark alert level.
     */
    public function dark(): self
    {
        $this->level = 'dark';

        return $this;
    }
}
