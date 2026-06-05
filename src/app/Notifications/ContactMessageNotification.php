<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMessageNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected ContactMessage $message
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nuevo mensaje de contacto: ' . $this->message->name)
            ->greeting('Nuevo mensaje de contacto')
            ->line('Nombre: ' . $this->message->name)
            ->line('Email: ' . $this->message->email)
            ->line('Mensaje:')
            ->line($this->message->message)
            ->action('Ver en panel', url('/admin/messages'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'action' => 'created',
            'model_type' => 'ContactMessage',
            'model_id' => $this->message->id,
            'label' => $this->message->name,
            'message' => "Nuevo mensaje de contacto de {$this->message->name}",
            'url' => route('admin.messages.index'),
        ];
    }
}
