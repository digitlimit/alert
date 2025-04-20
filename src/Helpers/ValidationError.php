<?php

namespace Digitlimit\Alert\Helpers;

use Illuminate\Support\MessageBag;

class ValidationError
{
    /**
     * Get Laravel errors.
     */
    public function errors(): MessageBag
    {
        $errors = session('errors');

        return $errors instanceof MessageBag
            ? $errors
            : new MessageBag();
    }

    /**
     * Get tagged view errors.
     */
    public function taggedErrors(string $tag): MessageBag
    {
        return $this->errors()->{$tag} ?? new MessageBag();
    }

    /**
     * Get tagged view errors.
     */
    public function error(string $name, string $tag): ?string
    {
        $taggedErrors = $this->taggedErrors($tag);

        if ($taggedErrors->has($name)) {
            return $taggedErrors->first($name);
        }

        return $this->errors()->first($name);
    }
}
