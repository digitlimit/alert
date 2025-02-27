<?php

namespace Digitlimit\Alert\Traits;

use Digitlimit\Alert\Events\FieldBag\Flashed;
use Digitlimit\Alert\Helpers\SessionKey;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

trait WithSticky
{
    protected bool $sticky = false;

    protected ?Carbon $stickyDuration = null;

    /**
     * Set the sticky property.
     */
    public function sticky(bool $sticky = true): self
    {
        $this->sticky = $sticky;

        return $this;
    }

    /**
     * Set the sticky property.
     */
    public function stickyDuration(Carbon $carbon): self
    {
        $this->stickyDuration = $carbon;

        return $this;
    }

    /**
     * Check if the alert is sticky.
     */
    public function isSticky(): bool
    {
        return $this->sticky;
    }

    /**
     * Flash the alert to the session.
     */
    public function flashSticky(): self
    {
        $sessionKey = SessionKey::key($this->key(), $this->getTag());

        if ($this->stickyDuration) {
            Cache::put($sessionKey, $this, $this->stickyDuration);
            Flashed::dispatch($this);

            return $this;
        }

        Session::put($sessionKey, $this);
        Flashed::dispatch($this);

        return $this;
    }
}
