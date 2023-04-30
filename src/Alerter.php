<?php

namespace Digitlimit\Alert;

use Illuminate\Support\Str;

class Alerter
{
    private AlertStore $store;

    private AlertLevel $level;

    private AlertType $type;

    private Message $message;

    private ?string $tag = null;

    public function __construct(AlertStore $store)
    {
        $this->store = $store;
    }

    protected function restore() : void
    {
        if($this->tag){
            $this->store->tag($this->tag);
        }

        $this->store->store($this);
    }

    public function setTag(string $tag) : self
    {
        $this->tag = Str::slug($tag);
        $this->restore();
        return $this;
    }

    public function setMessage(Message $message) : self
    {
        $this->message = $message;
        $this->restore();
        return $this;
    }

    public function setLevel(AlertLevel $level) : self
    {
        $this->level = $level;
        $this->restore();
        return $this;
    }

    public function setType(AlertType $type) : self
    {
        $this->type = $type;
        $this->restore();
        return $this;
    }

    public function getMessage() : Message
    {
        return $this->message;
    }

    public function getLevel() : AlertLevel
    {
        return $this->level;
    }

    public function getType() : AlertType
    {
        return $this->type;
    }

    public function getKey() : string
    {
        return $this->store->getKey();
    }
}
