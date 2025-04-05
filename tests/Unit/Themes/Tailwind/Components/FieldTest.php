<?php

use Digitlimit\Alert\Themes\Tailwind\Components\Field;
use Livewire\Livewire;

it('mounts and initializes correctly', function () {
    Livewire::test(Field::class, ['for' => 'test-field'])
        ->assertSet('name', 'test-field')
        ->assertSet('alert', []);
})->group('tailwind', 'components', 'field');