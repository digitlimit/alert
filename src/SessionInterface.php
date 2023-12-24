<?php

namespace Digitlimit\Alert;

/**
 * Interface SessionInterface
 */
interface SessionInterface
{
    /**
     * Flash alert to store.
     */
    public function flash(string $name, mixed $value): void;

    /**
     * Put alert in the store.
     */
    public function put(string $name, mixed $value): void;

    /**
     * Remove alert from store.
     */
    public function forget(string $key): void;

    /**
     * Fetch alert from the store.
     */
    public function get(string $key, mixed $default = null): mixed;
}
