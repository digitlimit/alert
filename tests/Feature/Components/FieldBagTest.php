<?php

use Digitlimit\Alert\Facades\Alert;

it('can render validation errors for the field view component', function () {
    $validator = validator(
        ['firstname' => '', 'lastname' => ''],
        [
            'firstname' => 'required',
            'lastname'  => 'required',
        ]
    );

    Alert::fieldBag($validator)
        ->tag('contact')
        ->error();

    $this
        ->blade('<x-alert-field name="firstname" tag="contact" />')
        ->assertSee('class="form-text text-danger"', false)
        ->assertSee('The firstname field is required');

    $this
        ->blade('<x-alert-field name="lastname" tag="contact" />')
        ->assertSee('class="form-text text-danger"', false)
        ->assertSee('The lastname field is required');
})->group('view-component', 'view-component-field-bag');
