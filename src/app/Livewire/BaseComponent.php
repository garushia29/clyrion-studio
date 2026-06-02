<?php

namespace App\Livewire;

use Livewire\Component as LivewireComponent;

/**
 * Base para todos los componentes Livewire del proyecto.
 *
 * Proporciona helpers para layout y mensajes flash
 * de éxito/error vía eventos del navegador.
 */
abstract class BaseComponent extends LivewireComponent
{
    protected ?string $layout = null;

    public function layout(string $layout): static
    {
        $this->layout = $layout;

        return $this;
    }

    public function flashSuccess(string $message): void
    {
        $this->dispatch('flash', type: 'success', message: $message);
    }

    public function flashError(string $message): void
    {
        $this->dispatch('flash', type: 'error', message: $message);
    }
}
