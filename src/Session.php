<?php

namespace Digitlimit\Alert;

use Illuminate\Session\Store;

/**
 * Class Session
 */
class Session implements SessionInterface
{
    /**
     * The store.
     */
    private Store $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Flash alert to store.
     */
    public function flash(string $key, mixed $value): void
    {
        $this->store->flash($key, $value);
    }

    /**
     * Put alert in the store.
     */
    public function put(string $key, mixed $value): void
    {
        $this->store->put($key, $value);
    }

    /**
     * Remove alert from store.
     */
    public function forget(string $key): void
    {
        $this->store->forget($key);
    }

    /**
     * Fetch alert from the store.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->store->get($key, $default);
    }
}
