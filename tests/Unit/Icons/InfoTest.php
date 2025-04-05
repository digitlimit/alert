<?php

use Digitlimit\Alert\Icons\Info;
use Illuminate\Support\Facades\View;

it('is circled by default', function () {
    $component = new Info();

    expect($component->isCircled())->toBeTrue();
})->group('icons', 'info-icon');

it('renders the correct view', function () {
    View::shouldReceive('make')
        ->once()
        ->with('alert::icons.info', [], [])
        ->andReturn('rendered-view');

    $component = new Info();

    expect($component->render())->toBe('rendered-view');
})->group('icons', 'info-icon', 'view');
