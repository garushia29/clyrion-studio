<?php

namespace App\Livewire\Admin;

use App\Models\WebhookCall;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;

class WebhookCallList extends AdminComponent
{
    use WithPagination;

    public $webhookId;
    public $selectedCall = null;

    public function mount($webhookId = null)
    {
        $this->webhookId = $webhookId;
    }

    protected function view(): View
    {
        $query = WebhookCall::with('webhook')->orderBy('created_at', 'desc');

        if ($this->webhookId) {
            $query->where('webhook_id', $this->webhookId);
        }

        return view('livewire.admin.webhook-call-list', [
            'calls' => $query->paginate(20),
        ]);
    }

    public function showDetail(WebhookCall $call)
    {
        $this->selectedCall = $call;
    }

    public function closeDetail()
    {
        $this->selectedCall = null;
    }
}
