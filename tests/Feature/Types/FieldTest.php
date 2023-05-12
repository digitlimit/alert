<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Types\Field;
use Digitlimit\Alert\Message\MessageInterface;

it('can create a field alert', function () 
{
    Alert::field('Thank you!')->flash();

    $default = Alert::default('field');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Field::class);
    expect($default->message)->toEqual('Thank you!');

})->name('types', 'types-field', 'types-field');
