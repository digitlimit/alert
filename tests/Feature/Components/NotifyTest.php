<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default notify alert', function () {
    Alert::notify('Thank you for joining us')
        ;

    $this
        ->blade('<x-alert-notify />')
        ->assertSee('class="position-fixed p-3 bottom-0 end-0"', false)
        ->assertSee('Thank you for joining us');
})->group('view-component', 'view-component-notify-default');

it('can render a tagged notify alert', function () {
    Alert::notify('Thank you for joining us')
        ->tag('contact')
        ;

    $this
        ->blade('<x-alert-notify tag="contact" />')
        ->assertSee('class="position-fixed p-3 bottom-0 end-0"', false)
        ->assertSee('Thank you for joining us');
})->group('view-component', 'view-component-notify-tagged');
