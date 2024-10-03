<?php

use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;

if (! function_exists('alert')) {
    function alert(string $message, string $title = null): mixed
    {
        $alert = app('alert')->message($message);

        if($title) {
            $alert->title($title);
        }

        return $alert;
    }
}

if (! function_exists('field')) {
    function field(string $name, string $message): mixed
    {
        return app('alert')
            ->field($message)
            ->name($name);
           
    }
}