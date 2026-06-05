<?php

namespace App\Livewire\Admin;

use App\Models\Webhook;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class WebhookList extends Component
{
    use WithPagination, AuthorizesRequests;

    public $showForm = false;
    public $editingWebhook = null;
    public $name = '';
    public $url = '';
    public $events = '';
    public $secret = '';
    public $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'url' => 'required|url|max:255',
        'events' => 'nullable|string|max:500',
        'secret' => 'nullable|string|max:255',
        'is_active' => 'boolean',
    ];

    public function render()
    {
        return view('livewire.admin.webhook-list', [
            'webhooks' => Webhook::withCount('calls')->orderBy('created_at', 'desc')->paginate(15),
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingWebhook = null;
    }

    public function edit(Webhook $webhook)
    {
        $this->editingWebhook = $webhook;
        $this->name = $webhook->name;
        $this->url = $webhook->url;
        $this->events = $webhook->events ?? '';
        $this->secret = $webhook->secret ?? '';
        $this->is_active = $webhook->is_active;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editingWebhook) {
            $this->editingWebhook->update([
                'name' => $this->name,
                'url' => $this->url,
                'events' => $this->events ?: null,
                'secret' => $this->secret ?: null,
                'is_active' => $this->is_active,
            ]);
            $this->dispatch('notify', type: 'success', message: 'Webhook actualizado.');
        } else {
            Webhook::create([
                'name' => $this->name,
                'url' => $this->url,
                'events' => $this->events ?: null,
                'secret' => $this->secret ?: null,
                'is_active' => $this->is_active,
            ]);
            $this->dispatch('notify', type: 'success', message: 'Webhook creado.');
        }

        $this->resetForm();
    }

    public function toggleActive(Webhook $webhook)
    {
        $webhook->update(['is_active' => !$webhook->is_active]);
        $this->dispatch('notify', type: 'success', message: 'Webhook ' . ($webhook->is_active ? 'activado.' : 'desactivado.'));
    }

    public function delete(Webhook $webhook)
    {
        $webhook->calls()->delete();
        $webhook->delete();
        $this->dispatch('notify', type: 'success', message: 'Webhook eliminado.');
    }

    public function resetForm()
    {
        $this->showForm = false;
        $this->editingWebhook = null;
        $this->name = '';
        $this->url = '';
        $this->events = '';
        $this->secret = '';
        $this->is_active = true;
        $this->resetErrorBag();
    }
}
