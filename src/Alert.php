<?php

namespace Digitlimit\Alert;

use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Message\MessageFactory;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Helpers\TypeHelper;
use Illuminate\Validation\Validator;
use Exception;

class Alert
{
    private string $defaultTag = 'default';

    public function __construct(
        protected Session $session
    ){}

    public function default(string $type) : MessageInterface|null
    {
        return self::tagged($type, $this->defaultTag);
    }

    public function tagged(string $type, string $tag) : MessageInterface|null
    {
        if(!TypeHelper::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        return $this->session->get(
            SessionKey::key($type, $tag)
        );
    }

    public function normal(string $message='') : MessageInterface
    {
        return MessageFactory::make($this->session, 'normal', $message);
    }

    public function field(string $message='', ?Validator $validator=null) : MessageInterface
    {
        return MessageFactory::make(
            $this->session, 'field', $message, $validator
        );
    }

    public function modal(string $message='') : MessageInterface
    {
        return MessageFactory::make($this->session, 'modal', $message);
    }

    public function notify(string $message='') : MessageInterface
    {
        return MessageFactory::make($this->session, 'notify', $message);
    }

    public function sticky(string $message='') : MessageInterface
    {
        return MessageFactory::make($this->session, 'sticky', $message);
    }

    public function message(string $message) : MessageInterface
    {
        return $this->normal($message);
    }

    public function from(string $type, string $message='', ...$args) : MessageInterface
    {
        if(!TypeHelper::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        return MessageFactory::make($this->session, $type, $message, ...$args);
    }
}