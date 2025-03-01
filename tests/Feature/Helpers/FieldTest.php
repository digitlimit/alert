<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Types\Field;

it('can create an alert with helper', function () {
    field('firstname', 'Invalid firstname');

    $default = Alert::named('field', 'firstname');

    expect($default)
        ->toBeInstanceOf(AlertInterface::class)
        ->and($default)
        ->toBeInstanceOf(Field::class)
        ->and($default->message)
        ->toEqual('Invalid firstname');

})->group('types', 'types-field');
