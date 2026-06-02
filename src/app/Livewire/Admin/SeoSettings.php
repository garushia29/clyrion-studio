<?php

namespace App\Livewire\Admin;

use App\Models\SeoSettings as SeoSettingsModel;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: SeoSettings
 *
 * Panel centralizado de configuración SEO. Permite gestionar
 * los meta tags (title, description, image, type) para cada
 * ruta pública del sitio desde un solo lugar.
 *
 * Las rutas disponibles se definen en el array $routes, que
 * también sirve como seed inicial al crear un registro nuevo.
 */
class SeoSettings extends AdminComponent
{
    public ?SeoSettingsModel $editing = null;

    public string $page_route = '';
    public string $title = '';
    public string $description = '';
    public ?string $image = null;
    public string $type = 'website';
    public bool $is_active = true;

    public bool $showForm = false;

    /** Rutas públicas disponibles para SEO */
    protected array $routes = [
        'home' => 'Inicio',
        'about' => 'Sobre mí',
        'projects.index' => 'Portafolio',
        'blog.index' => 'Blog',
        'tutorials.index' => 'Tutoriales',
    ];

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(SeoSettingsModel $seo): void
    {
        $this->editing = $seo;
        $this->page_route = $seo->page_route;
        $this->title = $seo->title;
        $this->description = $seo->description;
        $this->image = $seo->image;
        $this->type = $seo->type;
        $this->is_active = $seo->is_active;
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'page_route' => $this->page_route,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ?: null,
            'type' => $this->type,
            'is_active' => $this->is_active,
        ];

        if ($this->editing?->exists) {
            $this->editing->update($data);
            $this->flashSuccess('Configuración SEO actualizada correctamente.');
        } else {
            SeoSettingsModel::create($data);
            $this->flashSuccess('Configuración SEO creada correctamente.');
        }

        $this->resetForm();
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function toggleActive(SeoSettingsModel $seo): void
    {
        $seo->update(['is_active' => !$seo->is_active]);
    }

    public function delete(SeoSettingsModel $seo): void
    {
        $seo->delete();
        $this->flashSuccess('Configuración SEO eliminada correctamente.');
    }

    protected function resetForm(): void
    {
        $this->editing = null;
        $this->page_route = '';
        $this->title = '';
        $this->description = '';
        $this->image = null;
        $this->type = 'website';
        $this->is_active = true;
        $this->showForm = false;
    }

    protected function rules(): array
    {
        $unique = $this->editing?->exists
            ? 'unique:seo_settings,page_route,' . $this->editing->id
            : 'unique:seo_settings,page_route';

        return [
            'page_route' => "required|string|max:100|{$unique}",
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'image' => 'nullable|string|max:500',
            'type' => 'required|in:website,article,profile',
            'is_active' => 'boolean',
        ];
    }

    protected function view(): View
    {
        return view('livewire.admin.seo-settings', [
            'settings' => SeoSettingsModel::orderBy('page_route')->get(),
            'availableRoutes' => $this->routes,
        ]);
    }
}
