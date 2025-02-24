<?php

namespace Digitlimit\Alert\Contracts;

use Illuminate\View\View;
use Throwable;

interface HasView
{
    /**
     * Set a view for the alert.
     * @throws Throwable
     */
    public function view(View $view): self;

    /**
     * Set HTML string for the alert.
     */
    public function html(string $html): self;

    /**
     * Set the view for alert.
     */
    public function setView(string|View $view): self;

    /**
     * Get the view for alert.
     */
    public function getView(): ?string;

    /**
     * Determine if the alert has a view.
     */
    public function hasView(): bool;
}
