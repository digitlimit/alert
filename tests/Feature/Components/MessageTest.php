<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default message alert', function () {
    Alert::message('Thank you for joining us')
        ;

    $this
        ->blade('<x-alert-message />')
        ->assertSee('class="alert alert-dismissible alert-"', false)
        ->assertSee('Thank you for joining us');
})->group('view-component', 'view-component-message-default');
