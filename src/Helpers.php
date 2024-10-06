<?php

use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;

if (!function_exists('alert')) {
    function alert(string $message, string $title = null): mixed
    {
        $alert = app('alert')
            ->message($message)
            ->info();

        if ($title) {
            $alert->title($title);
        }

        return $alert;
    }
}

if (!function_exists('field')) {
    function field(string $name, string $message): mixed
    {
        return app('alert')
            ->field($message)
            ->name($name);
    }
}

if (!function_exists('fieldBag')) {
    function fieldBag(Validator|MessageBag $bag): mixed
    {
        return app('alert')
            ->fieldBag($bag);
    }
}

if (!function_exists('modal')) {
    function modal(string $message, string $title = null): mixed
    {
        $alert = app('alert')->modal($message);

        if ($title) {
            $alert->title($title);
        }

        return $alert;
    }
}

if (!function_exists('notify')) {
    function notify(string $message, string $title = null): mixed
    {
        $alert = app('alert')->notify($message);

        if ($title) {
            $alert->title($title);
        }

        return $alert;
    }
}

if (!function_exists('sticky')) {
    function sticky(string $message, string $title = null): mixed
    {
        $alert = app('alert')->sticky($message);

        if ($title) {
            $alert->title($title);
        }

        return $alert;
    }
}

if (!function_exists('forgetSticky')) {
    function forgetSticky(string $name = null): void
    {
        app('alert')->stickForget($name);
    }
}
