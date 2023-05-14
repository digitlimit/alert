<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default field view component', function () 
{
    Alert::field('Username is available')
        ->success()
        ->name('username')
        ->flash();

    $view = $this
        ->blade('<x-alert-field name="username" />');

    $view
        ->assertSee('class="form-text text-success"', false)
        ->assertSee('Username is available');
  
})->name('view-component', 'view-component-field-default');

it('can render a tagged field view component', function () 
{
    Alert::field('Please select a country')
        ->tag('contact')
        ->name('country')
        ->warning()
        ->flash();

    $view = $this
        ->blade('<x-alert-field name="country" tag="contact" />');

    $view
        ->assertSee('class="form-text text-warning"', false)
        ->assertSee('Please select a country');
  
})->name('view-component', 'view-component-field-tagged');

it('can render a named field view component', function () 
{
    Alert::field('Good, you chose a valid country')
        ->tag('contact')
        ->name('country')
        ->success()
        ->flash();

    Alert::field('Good, you chose a valid state')
        ->tag('contact')
        ->name('state')
        ->success()
        ->flash();

    $view = $this
        ->blade('<x-alert-field name="country" tag="contact" />');

    $view
        ->assertSee('class="form-text text-success"', false)
        ->assertSee('Good, you chose a valid country')
        ->assertDontSee('Good, you chose a valid state');
  
})->name('view-component', 'view-component-field-tagged');

it('can render validation errors for the field view component', function () 
{
    $validator = validator(
        ['firstname' => '', 'lastname' => ''], 
        [
            'firstname' => 'required', 
            'lastname'  => 'required'
        ]
    );

    Alert::field()
        ->tag('contact')
        ->errors($validator)
        ->error()
        ->flash();

    $this
        ->blade('<x-alert-field name="firstname" tag="contact" />')
        ->assertSee('class="form-text text-danger"', false)
        ->assertSee('The firstname field is required');

    $this
        ->blade('<x-alert-field name="lastname" tag="contact" />')
        ->assertSee('class="form-text text-danger"', false)
        ->assertSee('The lastname field is required');
  
})->name('view-component', 'view-component-field-tagged');
