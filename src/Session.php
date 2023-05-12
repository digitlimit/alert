<?php

namespace Digitlimit\Alert;

use Illuminate\Session\Store;

class Session implements SessionInterface
{
    private Store $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function flash(string $key, mixed $value) : void
    {
        $this->store->flash($key, $value);
    }

    public function get(string $key, mixed $default=null) : mixed
    {
        return $this->store->get($key, $default);
    }
}
