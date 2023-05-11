<?php

if (! function_exists('alert')) {

    function alert(string $message='', string $title='') : mixed
    {
        $alert = app('alert');

        if (! is_null($message)) {
            return $alert
                ->message($message)
                ->title($title)
                ->flash();
        }

        return $alert;
    }

}