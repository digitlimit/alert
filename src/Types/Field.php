<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Illuminate\Validation\Validator;
use Illuminate\Support\MessageBag;
use Digitlimit\Alert\Session;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Helpers\Helper;
use Exception;

class Field extends AbstractMessage implements MessageInterface
{
    /**
     * Field name
     */
    public ?string $name = null;

    /**
     * Field message back
     */
    public MessageBag $messages;

    /**
     * Create a new field alert instance.
     * @return void
     */
    public function __construct(
        protected Session $session, 
        public ?string $message
    ){
        $this->id(Helper::randomString());
        $this->messages = new MessageBag();
    }

    /**
     * Message store key for the field alert
     */
    public function key(): string
    {
        return 'field';
    }

    /**
     * Set field name
     */
    public function name(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set messages
     */
    public function messages(MessageBag $messages) : self
    { 
        $this->messages = $messages;
        return $this;
    }

    /**
     * Set errors
     */
    public function errors(Validator $validator) : self
    {
        $this->messages = $validator->errors();
        return $this;
    }

    /**
     * Fetch message for a given field name
     */
    public function messageFor(string $name) : string 
    {
        return $this->messages->first($name);
    }

    /**
     * Get field store tag
     */
    public function getTag() : string
    {
        if($this->name) {
            //e.g default.firstname
            return $this->tag . '.' . $this->name;
        }

        return $this->tag;
    }

    /**
     * Flash field instance to store
     */
    public function flash(string $message=null, string $level=null) : void 
    {
        $this->message = $message ?? $this->message;
        $this->level   = $level   ?? $this->level;

        if($this->messages->isEmpty() && empty($this->name)) {
            throw new Exception(
                "Messages or field name is required. Hint: messages(\$validator) or name(\$name)"
            );
        }

        $sessionKey = SessionKey::key($this->key(), $this->getTag()); 
        $this->session->flash($sessionKey, $this);
    }
}