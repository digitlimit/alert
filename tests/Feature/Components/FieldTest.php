<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default field view component', function () {
    Alert::field('username', 'Username is available')
        ->success();

    $view = $this
        ->blade('<x-alert-field name="username" />');

    $view
        ->assertSee('class="form-text text-success"', false)
        ->assertSee('Username is available');
})->group('view-component', 'view-component-field-default');

it('can render a tagged field view component', function () {
    Alert::field('country', 'Please select a country')
        ->tag('contact')
        ->warning();

    $view = $this
        ->blade('<x-alert-field name="country" tag="contact" />');

    $view
        ->assertSee('class="form-text text-warning"', false)
        ->assertSee('Please select a country');
})->group('view-component', 'view-component-field-tagged');

it('can render a named field view component', function () {
    Alert::field('country', 'Good, you chose a valid country')
        ->tag('contact')
        ->success();

    Alert::field('state', 'Good, you chose a valid state')
        ->tag('contact')
        ->success();

    $view = $this
        ->blade('<x-alert-field name="country" tag="contact" />');

    $view
        ->assertSee('class="form-text text-success"', false)
        ->assertSee('Good, you chose a valid country')
        ->assertDontSee('Good, you chose a valid state');
})->group('view-component', 'view-component-field-named-tagged');
