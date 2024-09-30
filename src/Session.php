<?php

namespace Digitlimit\Alert;

use Illuminate\Support\Facades\Session as Store;

class Session implements SessionInterface
{
    /**
     * Flash alert to store.
     */
    public function flash(string $key, mixed $value): void
    {
        Store::flash($key, $value);
    }

    /**
     * Put alert in the store.
     */
    public function put(string $key, mixed $value): void
    {
        Store::put($key, $value);
    }

    /**
     * Remove alert from store.
     */
    public function forget(string $key): void
    {
        Store::forget($key);
    }

    /**
     * Fetch alert from the store.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return Store::get($key, $default);
    }
}
