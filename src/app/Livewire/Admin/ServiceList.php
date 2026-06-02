<?php

/**
 * Livewire Component: ServiceList
 *
 * Lista paginada de servicios con búsqueda, activación/desactivación
 * y eliminación. Utiliza el trait WithListPagination para la gestión
 * de búsqueda y paginación estándar del panel admin.
 */
namespace App\Livewire\Admin;

use App\Models\Service;
use App\Livewire\Traits\WithListPagination;
use Illuminate\Contracts\View\View;

class ServiceList extends AdminComponent
{
    use WithListPagination;

    protected int $perPage = 20;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    /**
     * Elimina un servicio de la base de datos.
     */
    public function delete(Service $service): void
    {
        $service->delete();
        $this->flashSuccess('Servicio eliminado correctamente.');
    }

    /**
     * Alterna el estado activo/inactivo de un servicio.
     */
    public function toggleActive(Service $service): void
    {
        $service->update(['is_active' => !$service->is_active]);
        $this->flashSuccess($service->is_active ? 'Servicio activado.' : 'Servicio desactivado.');
    }

    /**
     * Renderiza la vista con la lista paginada de servicios.
     */
    protected function view(): View
    {
        return view('livewire.admin.service-list', [
            'services' => $this->applySearch(Service::query(), ['title', 'description'])
                ->orderBy('sort_order')
                ->orderBy('title')
                ->paginate($this->perPage),
        ]);
    }
}
