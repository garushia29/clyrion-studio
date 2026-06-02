<?php

/**
 * Livewire Component: ServiceForm
 *
 * Formulario de creación y edición de servicios. Utiliza el trait
 * WithSlugGeneration para auto-generar el slug desde el título,
 * con opción a personalizarlo manualmente.
 */
namespace App\Livewire\Admin;

use App\Models\Service;
use App\Livewire\Traits\WithSlugGeneration;
use Illuminate\Contracts\View\View;

class ServiceForm extends AdminComponent
{
    use WithSlugGeneration;

    /** Modelo existente en edición; null en creación */
    public ?Service $service = null;

    public string $title = '';
    public string $slug = '';
    public string $description = '';
    public string $icon = '';
    public int $sort_order = 0;
    public bool $is_active = true;

    /**
     * Inicializa el formulario con los datos del servicio en edición.
     */
    public function mount(?Service $service = null): void
    {
        if ($service?->exists) {
            $this->service = $service;
            $this->title = $service->title;
            $this->slug = $service->slug;
            $this->description = $service->description;
            $this->icon = $service->icon ?? '';
            $this->sort_order = $service->sort_order;
            $this->is_active = $service->is_active;
            $this->autoSlug = false;
        }
    }

    /**
     * Hook: Actualiza el slug automáticamente al cambiar el título.
     */
    public function updatedTitle(string $value): void
    {
        $this->updatedTitleAutoSlug($value);
    }

    /**
     * Guarda (crea o actualiza) el servicio y redirige al listado.
     */
    public function save(): void
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->resolveSlug($this->title, $this->slug),
            'description' => $this->description,
            'icon' => $this->icon,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
        ];

        if ($this->service?->exists) {
            $this->service->update($data);
            $this->flashSuccess('Servicio actualizado correctamente.');
        } else {
            Service::create($data);
            $this->flashSuccess('Servicio creado correctamente.');
        }

        $this->redirect(route('admin.services.index'), navigate: true);
    }

    /**
     * Reglas de validación para el formulario.
     * El slug debe ser único, ignorando el registro actual en edición.
     */
    protected function rules(): array
    {
        $unique = $this->service?->exists
            ? 'unique:services,slug,' . $this->service->id
            : 'unique:services,slug';

        return [
            'title' => 'required|string|max:255',
            'slug' => "nullable|string|max:255|{$unique}",
            'description' => 'required|string|max:500',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    protected function view(): View
    {
        return view('livewire.admin.service-form');
    }
}
