<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default sticky alert', function () {
    Alert::sticky('Thank you for joining us');

    $this
        ->blade('<x-alert-sticky />')
        ->assertSee('class="alert alert-dismissible alert-"', false)
        ->assertSee('Thank you for joining us');
})->group('view-component', 'view-component-sticky-default');

it('can render a tagged sticky alert', function () {
    Alert::sticky('Thank you for joining us')
        ->tag('contact');

    $this
        ->blade('<x-alert-sticky tag="contact" />')
        ->assertSee('class="alert alert-dismissible alert-"', false)
        ->assertSee('Thank you for joining us');
})->group('view-component', 'view-component-sticky-tagged');

it('can render a tagged sticky alert button', function () {
    Alert::sticky('Thank you for joining us')
        ->action('Pay');

    $this
        ->blade('<x-alert-sticky />')
        ->assertSee('class="alert alert-dismissible alert-"', false)
        ->assertSee('Pay');
})->group('view-component', 'view-component-sticky-button');
