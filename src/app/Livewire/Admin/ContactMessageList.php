<?php

namespace App\Livewire\Admin;

use App\Models\ContactMessage;
use App\Livewire\Traits\WithListPagination;

/**
 * Livewire Component: ContactMessageList
 *
 * Lista de mensajes de contacto con filtros por estado
 * (leído/no leído), búsqueda y acciones de gestión.
 */
class ContactMessageList extends AdminComponent
{
    use WithListPagination;

    public string $filter = '';

    protected int $perPage = 15;

    protected function queryString(): array
    {
        return [
            'search' => ['except' => ''],
            'filter' => ['except' => ''],
        ];
    }

    public function markAsRead(ContactMessage $message): void
    {
        $message->update(['read' => true]);
        $this->flashSuccess('Mensaje marcado como leído.');
    }

    public function markAsUnread(ContactMessage $message): void
    {
        $message->update(['read' => false]);
        $this->flashSuccess('Mensaje marcado como no leído.');
    }

    public function delete(ContactMessage $message): void
    {
        $message->delete();
        $this->flashSuccess('Mensaje eliminado correctamente.');
    }

    protected function view(): \Illuminate\Contracts\View\View
    {
        return view('livewire.admin.contact-message-list', [
            'messages' => $this->applySearch(ContactMessage::query(), ['name', 'email', 'message'])
                ->when($this->filter === 'unread', fn($q) => $q->unread())
                ->when($this->filter === 'read', fn($q) => $q->where('read', true))
                ->orderByDesc('created_at')
                ->paginate($this->perPage),
        ]);
    }
}
