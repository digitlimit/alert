<?php

use Digitlimit\Alert\Helpers\SessionKey;

it('can generate a session key from tag name and alert type', function () {
    $key = SessionKey::key('toastr', 'contact-form-1');

    expect($key)
        ->toEqual(SessionKey::MAIN_KEY.'.toastr.contact-form-1');
})->group('helpers', 'helpers-session-key');
