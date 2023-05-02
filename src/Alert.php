<?php

namespace Digitlimit\Alert;

use Digitlimit\Alert\Enums\Level;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Message\MessageFactory;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Helpers\TypeHelper;
use Exception;

class Alert
{
    protected Level $level;

    protected string $title      = '';
    protected string $message    = '';
    protected string $tag        = '';
    protected string $type       = 'bar';
    protected string $defaultTag = 'default';
   
    public function __construct(
        protected Session $session
    ){
        $this->level = Level::INFO;
    }

    public function title(string $title) : self
    {
        
        $this->title = $title;
        return $this;
    }

    public function message(string $message) : self
    {
        $this->message = $message;
        return $this;
    }

    public function tag(string $tag) : self
    {
        $this->tag = $tag;
        return $this;
    }

    public function success() : self
    {
        $this->level = Level::SUCCESS;
        return $this;
    }

    public function info() : self
    {
        $this->level = Level::INFO;
        return $this;
    }

    public function error() : self
    {
        $this->level = Level::ERROR;
        return $this;
    }

    public function warning() : self
    {
        $this->level = Level::WARNING;
        return $this;
    }

    public function type(string $type) : self 
    {
        if(!TypeHelper::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        $this->type = $type;

        return $this;
    }

    public function level(string $name) : self 
    {
        $level = Level::fromValue($name);

        if(!$level) {
            throw new Exception("Invalid level name: $name");
        }

        $this->level = $level;

        return $this;
    }

    public function default(string $type) : MessageInterface|null
    {
        return self::tagged($type, $this->defaultTag);
    }

    public function tagged(string $type, string $tag='') : MessageInterface|null
    {
        $taggedKey  = $tag ?? $this->defaultTag;
        $sessionKey = SessionKey::key($type, $taggedKey);

        return null;
    }

    public function flash(
        string $message='', 
        string $level='', 
        string $type=''
    ) : ?MessageInterface {

        if($message) {
            self::message($message);
        }

        if(empty($this->message)) {
            throw new Exception("Message cannot be empty string");
        }

        if($level) {
            self::level($level);
        }

        if($type) {
            self::type($type);
        }

        return MessageFactory::make(
            $this->message,
            $this->level,
            $this->type,
            $this->title
        );
    }
}
