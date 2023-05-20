<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Notify;

it('can create a notify alert', function () 
{
    Alert::notify('Thank you!')->flash();

    $default = Alert::default('notify');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Notify::class);
    expect($default->message)->toEqual('Thank you!');
    expect($default->key())->toEqual('notify');
})->name('types', 'types-notify', 'types-notify');

it('can create a notify alert position', function () 
{
    // top right
    Alert::notify('Thank you!')
    ->topRight()
    ->flash();

    $default = Alert::default('notify');
    expect($default->position)->toEqual('top-0 end-0');

    // top left
    Alert::notify('Thank you!')
    ->topLeft()
    ->flash();

    $default = Alert::default('notify');
    expect($default->position)->toEqual('top-0 start-0');

    // bottom right
    Alert::notify('Thank you!')
    ->bottomRight()
    ->flash();

    $default = Alert::default('notify');
    expect($default->position)->toEqual('bottom-0 end-0');

    // bottom left
    Alert::notify('Thank you!')
    ->bottomLeft()
    ->flash();

    $default = Alert::default('notify');
    expect($default->position)->toEqual('bottom-0 start-0');

    // centered
    Alert::notify('Thank you!')
    ->centered()
    ->flash();

    $default = Alert::default('notify');
    expect($default->position)->toEqual('top-50 start-50 translate-middle');

    // bottom center
    Alert::notify('Thank you!')
    ->bottomCenter()
    ->flash();

    $default = Alert::default('notify');
    expect($default->position)->toEqual('bottom-0 start-50 translate-middle-x');

})->name('types', 'types-notify', 'types-notify-position');
