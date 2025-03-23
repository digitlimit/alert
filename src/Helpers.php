<?php

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Types\Message;
use Digitlimit\Alert\Types\Field;
use Digitlimit\Alert\Types\Modal;
use Digitlimit\Alert\Types\Notify;
use Digitlimit\Alert\Types\Toastr;

if (! function_exists('alert')) {
    function alert(string $message, ?string $title = null): Message
    {
        $alert = app('alert')
            ->message($message);

        if ($title) {
            $alert->title($title);
        }

        return $alert;
    }
}

if (! function_exists('field')) {
    function field(string $name, string $message): Field
    {
        return app('alert')->field($name, $message);
    }
}

if (! function_exists('modal')) {
    function modal(string $message, ?string $title = null,): Modal
    {
        $alert = app('alert')->modal($message);

        if ($title) {
            $alert->title($title);
        }

        return $alert;
    }
}

if (! function_exists('toastr')) {
    function toastr(string $message, ?string $title = null,): Toastr
    {
        $alert = app('alert')->toastr($message);

        if ($title) {
            $alert->title($title);
        }

        return $alert;
    }
}

if (! function_exists('notify')) {
    function notify(string $message, ?string $title = null,): Notify
    {
        $alert = app('alert')->notify($message);

        if ($title) {
            $alert->title($title);
        }

        return $alert;
    }
}

if (! function_exists('forgetAlert')) {
    function forgetAlert(string $type, string $tag = Alert::DEFAULT_TAG): void
    {
        app('alert')->forget($type, $tag);
    }
}
