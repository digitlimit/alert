<?php

namespace Digitlimit\Alert;

use Illuminate\Support\Str;

class Alerter
{
    private AlertStore $store;

    private Level $level;

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

    public function setLevel(Level $level) : self
    {
        $this->level = $level;
        $this->restore();
        return $this;
    }

    public function getMessage() : Message
    {
        return $this->message;
    }

    public function getLevel() : Level
    {
        return $this->level;
    }

    public function getKey() : string
    {
        return $this->store->getKey();
    }
}
