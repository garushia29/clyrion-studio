<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use App\Livewire\Traits\WithListPagination;

/**
 * Livewire Component: ProjectList
 *
 * Lista paginada de proyectos con búsqueda y filtro
 * por estado (draft/published).
 */
class ProjectList extends AdminComponent
{
    use WithListPagination;

    protected int $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function delete(Project $project): void
    {
        $project->delete();
        $this->flashSuccess('Proyecto eliminado correctamente.');
    }

    protected function view(): \Illuminate\Contracts\View\View
    {
        return view('livewire.admin.project-list', [
            'projects' => $this->applySearch(Project::query(), ['title'])
                ->tap(fn($q) => $this->applyStatusFilter($q))
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->paginate($this->perPage),
        ]);
    }
}
