<?php
use Digitlimit\Alert\Message;

it('can set title', function () {
    $message = new Message();
    $message->setTitle('Congratualtions!');

    expect($message->hasTitle())->toBe(true);
    expect($message->getTitle())->toBe('Congratualtions!');
});

it('can set content', function () {
    $message = new Message();
    $message->setContent('This is a content');

    expect($message->hasContent())->toBe(true);
    expect($message->getContent())->toBe('This is a content');
});