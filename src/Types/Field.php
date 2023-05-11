<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Illuminate\Validation\Validator;
use Illuminate\Support\MessageBag;
use Digitlimit\Alert\Session;

class Field extends AbstractMessage implements MessageInterface
{
    public MessageBag $messages;

    public function __construct(
        protected Session $session, 
        public string $message
    ){
        $this->messages = new MessageBag();
    }

    public function name(): string
    {
        return 'field';
    }

    public function messages(MessageBag $messages)
    { 
        //just here
        $this->messages = $messages;
        return $this;
    }

    public function errors(Validator $validator)
    {
        $this->messages = $validator->errors();
        return $this;
    }

    public function messageFor(string $name) : string 
    {
        return $this->messages->first($name);
    }
}