<?php

use Digitlimit\Alert\Helpers\Theme;
use Digitlimit\Alert\Helpers\Helper;

it('can get the correct theme name', function ()
{
    $theme = Helper::config()->get('alert.theme');
    $this->assertEquals('classic', $theme);

    $this->assertEquals($theme, Theme::name());
})->group('theme', 'helpers', 'theme-name');

it('can get all themes', function ()
{
    $themes = Helper::config()->get('alert.themes');
    $this->assertIsArray($themes);

    $this->assertEquals($themes, Theme::all());
})->group('theme', 'helpers', 'theme-all');

it('can get the correct theme based on config', function ()
{
    // set a non-existent theme
    config(['alert.theme' => 'none']);

    $this->assertEquals(Theme::name(), 'none');
    $this->assertEquals(Theme::theme(), []);

    // set a valid theme
    config(['alert.theme' => 'classic']);
    $this->assertEquals(Theme::name(), 'classic');
    $this->assertEquals(Theme::theme(), config('alert.themes.classic'));
    $this->assertNotEquals(Theme::theme(), []);

})->group('theme', 'helpers', 'theme-theme');