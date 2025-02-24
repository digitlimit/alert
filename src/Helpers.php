<?php

use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;
use Digitlimit\Alert\Types\Message;

use Digitlimit\Alert\Types\Modal;
use Digitlimit\Alert\Types\Notify;
use Digitlimit\Alert\Types\Sticky;
use Digitlimit\Alert\Types\Field;
use Digitlimit\Alert\Types\FieldBag;


if (! function_exists('alert')) {
    function alert(string $message, ?string $title = null): Message
    {
        $alert = app('alert')
            ->message($message)
            ->info();

        if ($title) {
            $alert->title($title);
        }

        $alert->flash();

        return $alert;
    }
}

if (! function_exists('field')) {
    function field(string $name, string $message, ?string $tag = null): Field
    {
        $alert = app('alert')->field($name, $message);

        if ($tag) {
            $alert->tag($tag);
        }

        $alert->flash();

        return $alert;
    }
}

if (! function_exists('fieldBag')) {
    function fieldBag(Validator|MessageBag $bag): FieldBag
    {
        $bag = app('alert')
            ->fieldBag($bag);

        $bag->flash();

        return $bag;
    }
}

if (! function_exists('modal')) {
    function modal(string $message, ?string $title = null, ?string $tag = null): Modal
    {
        $alert = app('alert')->modal($message);

        if ($title) {
            $alert->title($title);
        }

        if ($tag) {
            $alert->tag($tag);
        }

        $alert->flash();

        return $alert;
    }
}

if (! function_exists('notify')) {
    function notify(string $message, ?string $title = null): Notify
    {
        $alert = app('alert')->notify($message);

        if ($title) {
            $alert->title($title);
        }

        $alert->flash();

        return $alert;
    }
}

if (! function_exists('sticky')) {
    function sticky(string $message, ?string $title = null): Sticky
    {
        $alert = app('alert')->sticky($message);

        if ($title) {
            $alert->title($title);
        }

        $alert->flash();

        return $alert;
    }
}

if (! function_exists('forgetSticky')) {
    function forgetSticky(?string $name = null): void
    {
        app('alert')->stickForget($name);
    }
}
