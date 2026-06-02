<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use App\Livewire\Traits\WithSlugGeneration;
use Illuminate\Support\Str;

/**
 * Livewire Component: ProjectForm
 *
 * Formulario de creación y edición de proyectos del portafolio.
 * Soporta tecnologías como string separado por comas, año,
 * enlaces y meta SEO.
 */
class ProjectForm extends AdminComponent
{
    use WithSlugGeneration;

    public ?Project $project = null;

    public string $title = '';
    public string $slug = '';
    public string $description = '';
    public string $content = '';
    public string $technologies = '';
    public string $year = '';
    public string $url = '';
    public string $github_url = '';
    public string $status = 'draft';
    public bool $featured = false;
    public int $sort_order = 0;
    public string $meta_title = '';
    public string $meta_description = '';

    public function mount(?Project $project = null): void
    {
        if ($project?->exists) {
            $this->project = $project;
            $this->title = $project->title;
            $this->slug = $project->slug;
            $this->description = $project->description;
            $this->content = $project->content;
            $this->technologies = $project->technologies ? implode(', ', $project->technologies) : '';
            $this->year = (string) $project->year;
            $this->url = $project->url;
            $this->github_url = $project->github_url;
            $this->status = $project->status;
            $this->featured = $project->featured;
            $this->sort_order = $project->sort_order;
            $this->meta_title = $project->meta_title;
            $this->meta_description = $project->meta_description;
            $this->autoSlug = false;
        }
    }

    public function updatedTitle(string $value): void
    {
        $this->updatedTitleAutoSlug($value);
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->resolveSlug($this->title, $this->slug),
            'description' => $this->description,
            'content' => $this->content,
            'technologies' => $this->technologies ? array_map('trim', explode(',', $this->technologies)) : [],
            'year' => $this->year ? (int) $this->year : null,
            'url' => $this->url,
            'github_url' => $this->github_url,
            'status' => $this->status,
            'featured' => $this->featured,
            'sort_order' => $this->sort_order,
            'meta_title' => $this->meta_title ?: $this->title,
            'meta_description' => $this->meta_description ?: $this->description,
        ];

        if ($this->project?->exists) {
            $this->project->update($data);
            $this->flashSuccess('Proyecto actualizado correctamente.');
        } else {
            Project::create($data);
            $this->flashSuccess('Proyecto creado correctamente.');
        }

        $this->redirect(route('admin.projects.index'), navigate: true);
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string',
            'technologies' => 'nullable|string|max:500',
            'year' => 'nullable|integer|min:1900|max:2100',
            'url' => 'nullable|url|max:500',
            'github_url' => 'nullable|url|max:500',
            'status' => 'required|in:draft,published',
            'featured' => 'boolean',
            'sort_order' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ];
    }

    protected function view(): \Illuminate\Contracts\View\View
    {
        return view('livewire.admin.project-form');
    }
}
