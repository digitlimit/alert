<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Types\Field;
use Digitlimit\Alert\Message\MessageInterface;

it('can create a field alert', function () 
{
    Alert::field('Invalid firstname')
        ->name('firstname')
        ->flash();

    $default = Alert::named('field', 'firstname');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Field::class);
    expect($default->message)->toEqual('Invalid firstname');

})->name('types', 'types-field', 'types-field');
