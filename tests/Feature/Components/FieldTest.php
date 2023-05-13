<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default field view component', function () 
{
    Alert::field('Username is available')
        ->success()
        ->flash();

    $view = $this
        ->blade('<x-alert-field />');

    $view
        ->assertSee('class="form-text text-success"', false)
        ->assertSee('Username is available');
  
})->name('view-component', 'view-component-field-default');

it('can render a tagged field view component', function () 
{
    Alert::field('Some errors occurred!')
        ->tag('contact')
        ->warning()
        ->flash();

    $view = $this
        ->blade('<x-alert-field tag="contact" />');

    $view
        ->assertSee('class="form-text text-warning"', false)
        ->assertSee('Some errors occurred!');
  
})->name('view-component', 'view-component-field-tagged');

it('can render a named field view component', function () 
{
    Alert::field('Good, you chose a valid country')
        ->tag('contact')
        ->name('country')
        ->success()
        ->flash();

    // Alert::field('Will not see this message because it has different name')
    //     ->tag('contact')
    //     ->name('state')
    //     ->success()
    //     ->flash();

    $view = $this
        ->blade('<x-alert-field name="country" tag="contact" />');

    $view
        ->assertSee('class="form-text text-success"', false)
        ->assertSee('Good, you chose a valid country');
  
})->name('view-component', 'view-component-field-tagged');

