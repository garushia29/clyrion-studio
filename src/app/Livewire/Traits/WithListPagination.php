<?php

namespace App\Livewire\Traits;

use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait: WithListPagination
 *
 * Proporciona funcionalidad común para listas paginadas:
 * búsqueda, filtro por estado, ordenamiento y reseteo de página.
 */
trait WithListPagination
{
    use WithPagination;

    public string $search = '';

    public string $status = '';

    public string $sortField = 'created_at';

    public string $sortDirection = 'desc';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    protected function applySearch(Builder $query, array $fields = ['title']): Builder
    {
        return $query->when($this->search, function (Builder $q) use ($fields) {
            $q->where(function (Builder $sub) use ($fields) {
                foreach ($fields as $field) {
                    $sub->orWhere($field, 'like', "%{$this->search}%");
                }
            });
        });
    }

    protected function applyStatusFilter(Builder $query, string $column = 'status'): Builder
    {
        return $query->when($this->status, fn(Builder $q) => $q->where($column, $this->status));
    }
}
