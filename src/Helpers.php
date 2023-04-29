<?php
use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Message;

if (! function_exists('alert')) {

    function alert(string $message='', string $title='') : Alert
    {
        $alert = app('alert');

        if (! is_null($message)) {
            return $alert->message($message, $title);
        }

        return $alert;
    }

}
