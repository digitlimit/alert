<?php

it('has alert with the given tag', function () 
{
    $alert = alert();
    $alert->tag('page footer');

    $alerter = $alert->alerter();
    expect($alerter->getKey())->toBe('digitlimit.alert.page-footer');
})->name('alert', 'alert-tag');