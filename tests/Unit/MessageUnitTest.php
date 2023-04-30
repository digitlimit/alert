<?php
use Digitlimit\Alert\Message;

it('has message with the given title', function () {
    $message = new Message();
    $message->setTitle('Congratualtions!');

    expect($message->hasTitle())->toBe(true);
    expect($message->getTitle())->toBe('Congratualtions!');
})->name('message', 'message-title');

it('has message with the given content', function () {
    $message = new Message();
    $message->setContent('This is a content');

    expect($message->hasContent())->toBe(true);
    expect($message->getContent())->toBe('This is a content');
})->name('message', 'message-content');