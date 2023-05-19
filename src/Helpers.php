<?php

if (!function_exists('alert')) {
    /**
     * Alert helper function that creates an instance of alert.
     */
    function alert(string $message = null, string $title = null): mixed
    {
        $alert = app('alert');

        if (!is_null($message)) {
            return $alert
                ->message($message)
                ->title($title)
                ->flash();
        }

        return $alert;
    }
}
