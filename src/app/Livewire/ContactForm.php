<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use App\Models\User;
use App\Notifications\ContactMessageNotification;
use Illuminate\Support\Facades\Notification;

/**
 * Livewire Component: ContactForm
 *
 * Formulario de contacto público. Almacena los mensajes
 * en la base de datos, notifica a los administradores
 * por email y muestra confirmación al usuario.
 */
class ContactForm extends BaseComponent
{
    public string $name = '';
    public string $email = '';
    public string $message = '';
    public bool $success = false;

    public function save(): void
    {
        $this->validate();

        $message = ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        Notification::send(User::admins()->get(), new ContactMessageNotification($message));

        $this->reset();
        $this->success = true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ];
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
