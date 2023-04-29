<?php

namespace Digitlimit\Alert;

use Illuminate\Session\Store;

class AlertStore
{
    protected Store $store;

    protected string $key = 'digitlimit.alert';

    protected string $tag = '';

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function getKey() : string
    {
        if($this->tag) {
            return "$this->key.$this->tag";
        }

        return $this->key;
    }

    public function tag(string $tag) : self
    {
        if($tag) {
            $this->tag = $tag;
        }
    
        return $this;
    }

    public function store(Alerter $alerter) : self
    {
        $this
            ->store
            ->put($this->getKey(), $alerter);

        return $this;
    }

    public function fetch() : Alerter
    {
        return $this
            ->store
            ->get($this->getKey()) ?? new Alerter();
    }
}
