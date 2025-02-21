<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;

class FieldBag extends AbstractMessage implements MessageInterface
{
    /**
     * Field message back.
     */
    public MessageBag $messages;

    /**
     * Create a new field alert instance.
     *
     * @return void
     */
    public function __construct(
        Validator|MessageBag|null $bag = null
    ) {
        $this->id($this->key().'-'.Helper::randomString());

        if (is_a($bag, Validator::class)) {
            $this->errors($bag);
        } elseif (is_a($bag, MessageBag::class)) {
            $this->messages($bag);
        } else {
            $this->messages = new MessageBag;
        }
    }

    /**
     * Message store key for the field alert.
     */
    public function key(): string
    {
        return 'bag';
    }

    /**
     * Set messages.
     */
    public function messages(MessageBag $messages): self
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * Set errors.
     */
    public function errors(Validator $validator): self
    {
        $this->messages = $validator->errors();
        return $this;
    }

    /**
     * Fetch a message for a given field name.
     */
    public function messageFor(string $name): string
    {
        return $this->messages->first($name);
    }

    /**
     * Convert the field bag alert to an array.
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => $this->key(),
            'messages' => $this->messages,
        ]);
    }

    /**
     * Fill the field bag alert from an array.
     */
    public static function fill(array $alert): MessageInterface
    {
        $bag = new static;
        $bag->id($alert['id']);
        $bag->messages($alert['messages']);
        return $bag;
    }
}
