<?php

namespace Digitlimit\Alert\Traits;

use Illuminate\View\View;
use Throwable;

trait WithView
{
    /**
     * The view HTML string if given.
     */
    public ?string $view = null;

    /**
     * Set a view for the modal.
     *
     * @throws Throwable
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
     * @throws Throwable
     */
    public function setView(string|View $view): self
    {
        if ($view instanceof View) {
            return $this->view($view);
        }

        return $this->html($view);
    }

    /**
     * Get the view for the modal.
     */
    public function getView(): ?string
    {
        return $this->view;
    }

    /**
     * Determine if the modal has a view.
     */
    public function hasView(): bool
    {
        return ! is_null($this->view);
    }
}
