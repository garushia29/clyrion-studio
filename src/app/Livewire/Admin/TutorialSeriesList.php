<?php

namespace App\Livewire\Admin;

use App\Models\TutorialSeries;
use App\Livewire\Traits\WithListPagination;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: TutorialSeriesList
 *
 * Lista paginada de series de tutoriales con búsqueda.
 * Previene eliminación de series que contienen tutoriales.
 */
class TutorialSeriesList extends AdminComponent
{
    use WithListPagination;

    protected int $perPage = 20;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete(TutorialSeries $series): void
    {
        if ($series->tutorials()->exists()) {
            $this->flashError('No se puede eliminar una serie que contiene tutoriales.');
            return;
        }

        $series->delete();
        $this->flashSuccess('Serie eliminada correctamente.');
    }

    protected function view(): View
    {
        return view('livewire.admin.tutorial-series-list', [
            'series' => $this->applySearch(TutorialSeries::query(), ['title', 'description'])
                ->withCount('tutorials')
                ->orderBy('sort_order')
                ->orderBy('title')
                ->paginate($this->perPage),
        ]);
    }
}
