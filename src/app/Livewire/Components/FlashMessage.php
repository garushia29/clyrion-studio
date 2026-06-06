<?php

namespace App\Livewire\Components;

use Livewire\Component;

/**
 * Livewire Component: FlashMessage
 *
 * Muestra mensajes flash temporales. Escucha el evento 'flash'
 * y soporta tipos success/error con auto-desvanecimiento.
 */
class FlashMessage extends Component
{
    public bool $visible = false;

    public string $type = 'success';

    public string $message = '';

    protected $listeners = ['flash' => 'show'];

    public function show($data = 'success', ?string $message = null): void
    {
        if (is_array($data)) {
            $this->type = $data['type'] ?? 'success';
            $this->message = $data['message'] ?? '';
        } else {
            $this->type = $data ?: 'success';
            $this->message = $message ?? '';
        }

        $this->visible = true;

        $this->dispatch('flash-shown');
    }

    public function dismiss(): void
    {
        $this->visible = false;
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.components.flash-message');
    }
}
