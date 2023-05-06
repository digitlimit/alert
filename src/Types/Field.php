<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Illuminate\Validation\Validator;
use Illuminate\Support\MessageBag;
use Digitlimit\Alert\Session;

class Field extends AbstractMessage implements MessageInterface
{
    public ?MessageBag $errors = null;

    public function __construct(
        protected Session $session, 
        public string $message
    ){}

    public function name(): string
    {
        return 'field';
    }

    public function withErrors(Validator $validator)
    {
        $this->errors = $validator->errors();
        return $this;
    }
}