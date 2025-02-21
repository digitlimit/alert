<?php

use Digitlimit\Alert\Facades\Alert;

it('can sets the correct levels', function () {
    $alert = Alert::message('Thank you!')->primary();
    expect($alert->level)->toEqual('primary');

    $alert = Alert::message('Thank you!')->secondary();
    expect($alert->level)->toEqual('secondary');

    $alert = Alert::message('Thank you!')->success();
    expect($alert->level)->toEqual('success');

    $alert = Alert::message('Thank you!')->info();
    expect($alert->level)->toEqual('info');

    $alert = Alert::message('Thank you!')->error();
    expect($alert->level)->toEqual('danger');

    $alert = Alert::message('Thank you!')->warning();
    expect($alert->level)->toEqual('warning');

    $alert = Alert::message('Thank you!')->light();
    expect($alert->level)->toEqual('light');

    $alert = Alert::message('Thank you!')->dark();
    expect($alert->level)->toEqual('dark');
})->name('traits', 'traits-levelable');
