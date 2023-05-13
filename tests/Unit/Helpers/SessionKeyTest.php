<?php

use Digitlimit\Alert\Helpers\SessionKey;

it('can generate a session key from tag name and alert type', function () 
{
    $key = SessionKey::key('notify', 'contact-form-1');

    expect($key)
        ->toEqual(SessionKey::MAIN_KEY . ".notify.contact-form-1");
   
})->name('helpers', 'helpers-session-key');