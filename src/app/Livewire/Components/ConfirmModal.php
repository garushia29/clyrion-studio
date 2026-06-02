<?php

namespace App\Livewire\Components;

use Livewire\Component;

/**
 * Livewire Component: ConfirmModal
 *
 * Modal de confirmación reutilizable. Escucha el evento
 * 'openConfirmModal' y dispara el evento configurado al confirmar.
 */
class ConfirmModal extends Component
{
    public bool $show = false;

    public string $title = 'Confirmar acción';

    public string $message = '¿Estás seguro de que deseas realizar esta acción?';

    public string $confirmText = 'Confirmar';

    public string $cancelText = 'Cancelar';

    public string $eventToConfirm = '';

    public ?array $eventData = null;

    protected $listeners = [
        'openConfirmModal' => 'open',
    ];

    public function open(array $data): void
    {
        $this->title = $data['title'] ?? $this->title;
        $this->message = $data['message'] ?? $this->message;
        $this->confirmText = $data['confirmText'] ?? $this->confirmText;
        $this->cancelText = $data['cancelText'] ?? $this->cancelText;
        $this->eventToConfirm = $data['event'] ?? '';
        $this->eventData = $data['data'] ?? null;
        $this->show = true;
    }

    public function confirm(): void
    {
        if ($this->eventToConfirm) {
            $this->dispatch($this->eventToConfirm, ...($this->eventData ?? []));
        }

        $this->resetModal();
    }

    public function cancel(): void
    {
        $this->resetModal();
    }

    protected function resetModal(): void
    {
        $this->show = false;
        $this->eventToConfirm = '';
        $this->eventData = null;
    }

    public function render()
    {
        return view('livewire.components.confirm-modal');
    }
}
