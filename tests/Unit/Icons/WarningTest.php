<?php

use Digitlimit\Alert\Icons\Warning;
use Illuminate\Support\Facades\View;

it('is circled by default', function () {
    $component = new Warning();

    expect($component->isCircled())->toBeTrue();
})->group('icons', 'warning-icon');

it('renders the correct view', function () {
    View::shouldReceive('make')
        ->once()
        ->with('alert::icons.warning', [], [])
        ->andReturn('rendered-view');

    $component = new Warning();

    expect($component->render())->toBe('rendered-view');
})->group('icons', 'warning-icon', 'view');
