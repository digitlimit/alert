<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Component\Button;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\SessionInterface;
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
        protected SessionInterface $session,
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
        $this->flash();

        return $this;
    }

    /**
     * Set the cancel button.
     */
    public function cancel(string $label, ?string $link = null, array $attributes = []): self
    {
        $this->cancel = new Button($label, $link, $attributes);
        $this->flash();

        return $this;
    }

    /**
     * Set modal to scrollable.
     */
    public function scrollable(
        string $class = 'modal-dialog-scrollable'
    ): self {
        $this->scrollable = $class;
        $this->flash();

        return $this;
    }

    /**
     * Set modal size to small.
     */
    public function small(string $class = 'modal-sm'): self
    {
        $this->size = $class;
        $this->flash();

        return $this;
    }

    /**
     * Set modal size to large.
     */
    public function large(string $class = 'modal-lg'): self
    {
        $this->size = $class;
        $this->flash();

        return $this;
    }

    /**
     * Set modal size to extra-large.
     */
    public function extraLarge(string $class = 'modal-xl'): self
    {
        $this->size = $class;
        $this->flash();

        return $this;
    }

    /**
     * Set modal size to fullscreen.
     */
    public function fullscreen(string $class = 'modal-fullscreen'): self
    {
        $this->size = $class;
        $this->flash();

        return $this;
    }

    /**
     * Set modal position to center.
     */
    public function centered(string $class = 'modal-dialog-centered'): self
    {
        $this->position = $class;
        $this->flash();

        return $this;
    }

    /**
     * Set a view for the modal.
     */
    public function view(View $view): self
    {
        $this->view = $view->render();
        $this->flash();

        return $this;
    }

    /**
     * Set HTML string for the modal.
     */
    public function html(string $html): self
    {
        $this->view = $html;
        $this->flash();

        return $this;
    }
}
