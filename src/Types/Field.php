<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Illuminate\Validation\Validator;
use Illuminate\Support\MessageBag;
use Digitlimit\Alert\Session;
use Digitlimit\Alert\Helpers\SessionKey;
use Exception;

class Field extends AbstractMessage implements MessageInterface
{
    public ?string    $name = null;
    public MessageBag $messages;

    public function __construct(
        protected Session $session, 
        public ?string $message
    ){
        $this->messages = new MessageBag();
    }

    public function key(): string
    {
        return 'field';
    }

    public function name(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    public function messages(MessageBag $messages) : self
    { 
        $this->messages = $messages;
        return $this;
    }

    public function errors(Validator $validator) : self
    {
        $this->messages = $validator->errors();
        return $this;
    }

    public function messageFor(string $name) : string 
    {
        return $this->messages->first($name);
    }

    public function getTag() : string
    {
        if($this->name) {
            //e.g default.firstname
            return $this->tag . '.' . $this->name;
        }

        return $this->tag;
    }

    public function flash(string $message=null, string $level=null) : void 
    {
        $this->message = $message ?? $this->message;
        $this->level   = $level   ?? $this->level;

        if($this->messages->isEmpty() && empty($this->name)) {
            throw new Exception(
                "Messages or field name is require. Hint: messages(\$validator) or name(\$name)"
            );
        }

        $sessionKey = SessionKey::key($this->key(), $this->getTag()); 
        $this->session->flash($sessionKey, $this);
    }
}