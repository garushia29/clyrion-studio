<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Str;

class ProjectForm extends Component
{
    public ?Project $project = null;

    public $title = '';
    public $slug = '';
    public $description = '';
    public $content = '';
    public $technologies = '';
    public $year = '';
    public $url = '';
    public $github_url = '';
    public $status = 'draft';
    public $featured = false;
    public $sort_order = 0;
    public $meta_title = '';
    public $meta_description = '';

    public $showSlugEditor = false;
    public $autoSlug = true;

    public function mount(?Project $project = null)
    {
        if ($project?->exists) {
            $this->project = $project;
            $this->title = $project->title;
            $this->slug = $project->slug;
            $this->description = $project->description;
            $this->content = $project->content;
            $this->technologies = $project->technologies ? implode(', ', $project->technologies) : '';
            $this->year = $project->year;
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

    public function updatedTitle($value)
    {
        if ($this->autoSlug) {
            $this->slug = Str::slug($value);
        }
    }

    public function toggleSlugEditor()
    {
        $this->showSlugEditor = !$this->showSlugEditor;
        if ($this->showSlugEditor) {
            $this->autoSlug = false;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug ?: Str::slug($this->title),
            'description' => $this->description,
            'content' => $this->content,
            'technologies' => $this->technologies ? array_map('trim', explode(',', $this->technologies)) : [],
            'year' => $this->year ? (int) $this->year : null,
            'url' => $this->url,
            'github_url' => $this->github_url,
            'status' => $this->status,
            'featured' => $this->featured,
            'sort_order' => (int) $this->sort_order,
            'meta_title' => $this->meta_title ?: $this->title,
            'meta_description' => $this->meta_description ?: $this->description,
        ];

        if ($this->project?->exists) {
            $this->project->update($data);
            session()->flash('message', 'Proyecto actualizado correctamente.');
        } else {
            Project::create($data);
            session()->flash('message', 'Proyecto creado correctamente.');
        }

        $this->redirect(route('admin.projects.index'), navigate: true);
    }

    protected function rules()
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

    public function render()
    {
        return view('livewire.admin.project-form')->layout('layouts.app');
    }
}
