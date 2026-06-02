<?php

namespace App\Livewire\Admin;

use App\Models\Tutorial;
use App\Livewire\Traits\WithListPagination;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: TutorialList
 *
 * Lista paginada de tutoriales con búsqueda y filtro
 * por estado (draft/published).
 */
class TutorialList extends AdminComponent
{
    use WithListPagination;

    protected int $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function delete(Tutorial $tutorial): void
    {
        $tutorial->tags()->detach();
        $tutorial->delete();
        $this->flashSuccess('Tutorial eliminado correctamente.');
    }

    protected function view(): View
    {
        return view('livewire.admin.tutorial-list', [
            'tutorials' => $this->applySearch(Tutorial::query()->with('series'), ['title', 'excerpt'])
                ->tap(fn($q) => $this->applyStatusFilter($q))
                ->orderByDesc('created_at')
                ->paginate($this->perPage),
        ]);
    }
}
