<?php
use Digitlimit\Alert\Message;

it('has alert with the given message content', function () 
{
    $alert = alert();
    $alert->message('Thank you!');

    $alerter = $alert->alerter();
    expect($alerter->getMessage()->getContent())->toEqual('Thank you!');
})->name('alert-message', 'alert-message-content');

it('has alert with the given message title', function () 
{
    $alert = alert();
    $alert->message('Thank you!', 'Title 1');

    $alerter = $alert->alerter();
    expect($alerter->getMessage()->getTitle())->toEqual('Title 1');
})->name('alert-message', 'alert-message-title');

it('has alert with the given message object', function () 
{
    $alert = alert();
    $alert->message('Thank you!', 'Title 2');

    $alerter = $alert->alerter();
    expect($alerter->getMessage())->toEqual(new Message('Thank you!', 'Title 2'));
})->name('alert-message', 'alert-message-complete');
