<?php

namespace Digitlimit\Alert;

use Illuminate\Session\Store;

class Session implements SessionInterface
{
    /**
     * The store
     */
    private Store $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Flash alert to store
     */
    public function flash(string $key, mixed $value) : void
    {
        $this->store->flash($key, $value);
    }

    /**
     * Fetch alert from the store
     */
    public function get(string $key, mixed $default=null) : mixed
    {
        return $this->store->get($key, $default);
    }
}
