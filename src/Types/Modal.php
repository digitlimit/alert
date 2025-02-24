<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Component\Button;
use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Contracts\Scrollable;
use Digitlimit\Alert\Contracts\Sizable;

use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Events\Modal\Flashed;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Illuminate\View\View;

use Digitlimit\Alert\Traits;

class Modal extends AbstractMessage implements MessageInterface, Levelable, Scrollable, Sizable, Taggable
{
    use Traits\Levelable;
    use Traits\Scrollable;
    use Traits\Sizable;
    use Traits\Taggable;

    /**
     * An instance of action button.
     */
    public Button $action;

    /**
     * An instance of cancel button.
     */
    public Button $cancel;

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
            'message' => $this->getMessage(),
            'level' => $this->getLevel(),
            'tag' => $this->getTag(),
            'action' => $this->action->toArray(),
            'cancel' => $this->cancel->toArray(),
            'size' => $this->getSize(),
            'scrollable' => $this->isScrollable(),
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
        $modal->view = $alert['view'];

        return $modal;
    }

    /**
     * Flash field instance to store.
     */
    public function flash(): void
    {
        parent::flash();

        Flashed::dispatch($this);
    }
}
