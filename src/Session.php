<?php

namespace Digitlimit\Alert;

use Illuminate\Session\Store;

class Session implements SessionInterface
{
    private Store $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function flash(string $key, mixed $value) : void
    {
        $this->session->flash($key, $value);
    }

    public function get(string $key, mixed $default=null) : mixed
    {
        return $this->session->get($key, $default);
    }
}
