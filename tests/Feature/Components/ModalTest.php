<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default modal view component', function () {
    Alert::modal('Than you for joining us');

    $this
        ->blade('<x-alert-modal />')
        ->assertSee('class="modal"', false)
        ->assertSee('Than you for joining us');
})->group('view-component', 'view-component-modal-default');

it('can render a default modal with buttons and title', function () {
    Alert::modal('Your message has been recieved, you will hear from us soon')
        ->action('Yes')
        ->cancel('Cancel')
        ->centered()
        ->title('Please login')
        ->error();

    $view = $this
        ->blade('<x-alert-modal />');

    $view
        ->assertSee('class="modal"', false)
        ->assertSee('Yes')
        ->assertSee('Cancel')
        ->assertSee('Please login')
        ->assertSee('Your message has been recieved, you will hear from us soon');
})->group('view-component', 'view-component-modal-buttons-title');

it('can render a default modal a the right position', function () {
    Alert::modal()
        ->centered('centered');

    $view = $this
        ->blade('<x-alert-modal />');

    $view
        ->assertSee('class="modal-dialog  centered "', false);
})->group('view-component', 'view-component-modal-position');

it('can render a default modal a the right size', function () {
    Alert::modal()
        ->small();

    $this
        ->blade('<x-alert-modal />')
        ->assertSee('class="modal-dialog modal-sm  "', false);

    Alert::modal()
        ->large();

    $this
        ->blade('<x-alert-modal />')
        ->assertSee('class="modal-dialog modal-lg  "', false);

    Alert::modal()
        ->extraLarge();

    $this
        ->blade('<x-alert-modal />')
        ->assertSee('class="modal-dialog modal-xl  "', false);

    Alert::modal()
        ->fullscreen();

    $this
        ->blade('<x-alert-modal />')
        ->assertSee('class="modal-dialog modal-fullscreen  "', false);
})->group('view-component', 'view-component-modal-size');
