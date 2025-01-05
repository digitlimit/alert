<?php

use Digitlimit\Alert\Helpers\Theme;
use Digitlimit\Alert\Helpers\Helper;

it('can get the correct theme name', function ()
{
    $theme = Helper::config()->get('alert.theme');

    expect($theme)
        ->toEqual('classic')
        ->and(Theme::name())->toEqual('classic');

})->group('theme', 'helpers', 'theme-name');

it('can get all themes', function ()
{
    $themes = Helper::config()->get('alert.themes');
    $this->assertIsArray($themes);

    expect($themes)
        ->not()->toBeEmpty()
        ->toBeArray()
        ->toEqual(Theme::all());

})->group('theme', 'helpers', 'theme-all');

it('can get the correct theme based on config', function ()
{
    // set a non-existent theme
    config(['alert.theme' => 'none']);

    expect(Theme::name())
        ->toEqual('none')
        ->and(Theme::theme())
        ->toBeArray()
        ->toBeEmpty();

    // set a valid theme
    config(['alert.theme' => 'classic']);
    expect(Theme::name())
        ->toEqual('classic')
        ->and(Theme::theme())
        ->toBeArray()
        ->not()->toBeEmpty()
        ->toEqual(config('alert.themes.classic'));

})->group('theme', 'helpers', 'theme-theme');