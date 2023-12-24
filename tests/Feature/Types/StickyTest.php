<?php

use Digitlimit\Alert\Component\Button;
use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Sticky;

it('can create a sticky alert', function () {
    Alert::sticky('Thank you!')->flash();

    $default = Alert::default('sticky');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Sticky::class);
    expect($default->message)->toEqual('Thank you!');
})->name('types', 'types-sticky', 'types-sticky-message');

it('can create a sticky alert title', function () {
    Alert::sticky('Thank for ordering pizza!')
        ->title('Order')
        ->flash();

    $default = Alert::default('sticky');

    expect($default->title)->toEqual('Order');
    expect($default->message)->toEqual('Thank for ordering pizza!');
})->name('types', 'types-sticky', 'types-sticky-title');

it('can create a sticky alert button', function () {
    Alert::sticky()
        ->action('Yes')
        ->flash();

    $default = Alert::default('sticky');
    expect($default->action)->toBeInstanceOf(Button::class);
})->name('types', 'types-sticky', 'types-sticky-button');
