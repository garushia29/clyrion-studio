<?php

namespace App\Livewire\Admin;

use App\Models\Redirect;
use Illuminate\Contracts\View\View;

class RedirectList extends AdminComponent
{
    public ?Redirect $editing = null;

    public string $old_url = '';
    public string $new_url = '';
    public int $status_code = 301;
    public bool $is_active = true;

    public bool $showForm = false;
    public string $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(Redirect $redirect): void
    {
        $this->editing = $redirect;
        $this->old_url = $redirect->old_url;
        $this->new_url = $redirect->new_url;
        $this->status_code = $redirect->status_code;
        $this->is_active = $redirect->is_active;
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'old_url' => trim($this->old_url, '/'),
            'new_url' => $this->new_url,
            'status_code' => $this->status_code,
            'is_active' => $this->is_active,
        ];

        if ($this->editing?->exists) {
            $this->editing->update($data);
            $this->flashSuccess('Redirección actualizada correctamente.');
        } else {
            Redirect::create($data);
            $this->flashSuccess('Redirección creada correctamente.');
        }

        $this->resetForm();
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function toggleActive(Redirect $redirect): void
    {
        $redirect->update(['is_active' => !$redirect->is_active]);
    }

    public function delete(Redirect $redirect): void
    {
        $redirect->delete();
        $this->flashSuccess('Redirección eliminada correctamente.');
    }

    public function resetHits(Redirect $redirect): void
    {
        $redirect->update(['hits' => 0, 'last_hit_at' => null]);
        $this->flashSuccess('Contador de accesos reiniciado.');
    }

    protected function resetForm(): void
    {
        $this->editing = null;
        $this->old_url = '';
        $this->new_url = '';
        $this->status_code = 301;
        $this->is_active = true;
        $this->showForm = false;
    }

    protected function rules(): array
    {
        $unique = $this->editing?->exists
            ? 'unique:redirects,old_url,' . $this->editing->id
            : 'unique:redirects,old_url';

        return [
            'old_url' => "required|string|max:500|{$unique}",
            'new_url' => 'required|string|max:500',
            'status_code' => 'required|in:301,302',
            'is_active' => 'boolean',
        ];
    }

    protected function view(): View
    {
        $query = Redirect::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('old_url', 'like', "%{$this->search}%")
                  ->orWhere('new_url', 'like', "%{$this->search}%");
            });
        }

        return view('livewire.admin.redirect-list', [
            'redirects' => $query->orderBy('hits', 'desc')->orderBy('old_url')->get(),
        ]);
    }
}
