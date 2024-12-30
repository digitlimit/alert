<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Field;

it('can create an alert', function () {
    Alert::field('firstname', 'Invalid firstname');

    $default = Alert::named('field', 'firstname');

    expect($default)
        ->toBeInstanceOf(MessageInterface::class)
        ->and($default)
        ->toBeInstanceOf(Field::class)
        ->and($default->message)
        ->toEqual('Invalid firstname');

})->group('types', 'types-field', 'types-field');
