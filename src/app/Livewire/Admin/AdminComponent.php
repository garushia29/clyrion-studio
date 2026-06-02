<?php

namespace App\Livewire\Admin;

use App\Livewire\BaseComponent;

/**
 * Base para componentes Livewire del panel admin.
 *
 * Proporciona el layout por defecto y obliga a implementar
 * el método view() para separar la lógica de presentación.
 */
abstract class AdminComponent extends BaseComponent
{
    public function render()
    {
        return $this->view()->layout('layouts.app');
    }

    abstract protected function view(): \Illuminate\Contracts\View\View;
}
