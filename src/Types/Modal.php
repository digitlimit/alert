<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Component\Button;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Illuminate\View\View;

class Modal extends AbstractMessage implements MessageInterface
{
    /**
     * An instance of action button.
     */
    public Button $action;

    /**
     * An instance of cancel button.
     */
    public Button $cancel;

    /**
     * The modal size.
     */
    public ?string $size = null;

    /**
     * The scrollable class for modal if given.
     */
    public ?string $scrollable = null;

    /**
     * The position of the modal on the screen if given.
     */
    public ?string $position = null;

    /**
     * The view HTML string if given.
     */
    public ?string $view = null;

    /**
     * Create a new modal alert instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $message
    ) {
        $this->id($this->key().'-'.Helper::randomString());
        $this->action = new Button;
        $this->cancel = new Button;
    }

    /**
     * Message store key for the modal alert.
     */
    public function key(): string
    {
        return 'modal';
    }

    /**
     * Set the action button.
     */
    public function action(string $label, ?string $link = null, array $attributes = []): self
    {
        $this->action = new Button($label, $link, $attributes);

        return $this;
    }

    /**
     * Set the cancel button.
     */
    public function cancel(string $label, ?string $link = null, array $attributes = []): self
    {
        $this->cancel = new Button($label, $link, $attributes);

        return $this;
    }

    /**
     * Set modal to scrollable.
     */
    public function scrollable(
        string $class = 'modal-dialog-scrollable'
    ): self {
        $this->scrollable = $class;

        return $this;
    }

    /**
     * Set modal size to small.
     */
    public function small(string $class = 'modal-sm'): self
    {
        $this->size = $class;

        return $this;
    }

    /**
     * Set modal size to large.
     */
    public function large(string $class = 'modal-lg'): self
    {
        $this->size = $class;

        return $this;
    }

    /**
     * Set modal size to extra-large.
     */
    public function extraLarge(string $class = 'modal-xl'): self
    {
        $this->size = $class;

        return $this;
    }

    /**
     * Set modal size to fullscreen.
     */
    public function fullscreen(string $class = 'modal-fullscreen'): self
    {
        $this->size = $class;

        return $this;
    }

    /**
     * Set modal position to center.
     */
    public function centered(string $class = 'modal-dialog-centered'): self
    {
        $this->position = $class;

        return $this;
    }

    /**
     * Set a view for the modal.
     */
    public function view(View $view): self
    {
        $this->view = $view->render();

        return $this;
    }

    /**
     * Set HTML string for the modal.
     */
    public function html(string $html): self
    {
        $this->view = $html;

        return $this;
    }

    /**
     * Convert the modal alert to an array.
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => $this->key(),
            'message' => $this->message,
            'action' => $this->action->toArray(),
            'cancel' => $this->cancel->toArray(),
            'size' => $this->size,
            'scrollable' => $this->scrollable,
            'position' => $this->position,
            'view' => $this->view,
        ]);
    }

    /**
     * Fill the modal alert from an array.
     */
    public static function fill(array $alert): MessageInterface
    {
        $modal = new static($alert['message']);
        $modal->id($alert['id']);
        $modal->action = Button::fill($alert['action']);
        $modal->cancel = Button::fill($alert['cancel']);
        $modal->size = $alert['size'];
        $modal->scrollable = $alert['scrollable'];
        $modal->position = $alert['position'];
        $modal->view = $alert['view'];

        return $modal;
    }
}
