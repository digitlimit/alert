<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default sticky alert', function () {
    Alert::sticky('Thank you for joining us')
    ->flash();

    $this
    ->blade('<x-alert-sticky />')
    ->assertSee('class="alert alert-dismissible alert-"', false)
    ->assertSee('Thank you for joining us');
})->name('view-component', 'view-component-sticky-default');

it('can render a tagged sticky alert', function () {
    Alert::sticky('Thank you for joining us')
    ->tag('contact')
    ->flash();

    $this
    ->blade('<x-alert-sticky tag="contact" />')
    ->assertSee('class="alert alert-dismissible alert-"', false)
    ->assertSee('Thank you for joining us');
})->name('view-component', 'view-component-sticky-tagged');

it('can render a tagged sticky alert button', function () {
    Alert::sticky('Thank you for joining us')
    ->action('Pay')
    ->flash();

    $this
    ->blade('<x-alert-sticky />')
    ->assertSee('class="alert alert-dismissible alert-"', false)
    ->assertSee('Pay');
})->name('view-component', 'view-component-sticky-button');
