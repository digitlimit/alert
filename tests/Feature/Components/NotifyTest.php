<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default notify alert', function () {
    Alert::notify('Thank you for joining us')
    ->flash();

    $this
    ->blade('<x-alert-notify />')
    ->assertSee('class="position-fixed p-3 bottom-0 end-0"', false)
    ->assertSee('Thank you for joining us');
})->name('view-component', 'view-component-notify-default');

it('can render a tagged notify alert', function () {
    Alert::notify('Thank you for joining us')
    ->tag('contact')
    ->flash();

    $this
    ->blade('<x-alert-notify tag="contact" />')
    ->assertSee('class="position-fixed p-3 bottom-0 end-0"', false)
    ->assertSee('Thank you for joining us');
})->name('view-component', 'view-component-notify-tagged');
