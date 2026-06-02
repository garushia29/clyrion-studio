<?php

namespace App\Livewire\Admin;

use App\Models\Tutorial;
use App\Models\TutorialSeries;
use App\Models\Tag;
use App\Livewire\Traits\WithSlugGeneration;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: TutorialForm
 *
 * Formulario de creación y edición de tutoriales.
 * Soporta asignación a series, tags, dificultad, meta SEO
 * y auto-generación de slug.
 */
class TutorialForm extends AdminComponent
{
    use WithSlugGeneration;

    public ?Tutorial $tutorial = null;

    public string $title = '';
    public string $slug = '';
    public string $excerpt = '';
    public string $content = '';
    public ?int $series_id = null;
    public int $order_in_series = 0;
    public string $difficulty = 'intermediate';
    public ?int $duration_minutes = null;
    public string $prerequisites = '';
    public string $thumbnail = '';
    public string $status = 'draft';
    public string $meta_title = '';
    public string $meta_description = '';
    public array $selectedTags = [];

    public function mount(?Tutorial $tutorial = null): void
    {
        if ($tutorial?->exists) {
            $this->tutorial = $tutorial;
            $this->title = $tutorial->title;
            $this->slug = $tutorial->slug;
            $this->excerpt = $tutorial->excerpt ?? '';
            $this->content = $tutorial->content;
            $this->series_id = $tutorial->series_id;
            $this->order_in_series = $tutorial->order_in_series;
            $this->difficulty = $tutorial->difficulty;
            $this->duration_minutes = $tutorial->duration_minutes;
            $this->prerequisites = $tutorial->prerequisites ?? '';
            $this->thumbnail = $tutorial->thumbnail ?? '';
            $this->status = $tutorial->status;
            $this->meta_title = $tutorial->meta_title ?? '';
            $this->meta_description = $tutorial->meta_description ?? '';
            $this->selectedTags = $tutorial->tags()->pluck('tags.id')->map(fn($id) => (string) $id)->toArray();
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
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'series_id' => $this->series_id ?: null,
            'order_in_series' => $this->order_in_series,
            'difficulty' => $this->difficulty,
            'duration_minutes' => $this->duration_minutes,
            'prerequisites' => $this->prerequisites,
            'thumbnail' => $this->thumbnail,
            'status' => $this->status,
            'meta_title' => $this->meta_title ?: $this->title,
            'meta_description' => $this->meta_description ?: $this->excerpt,
            'published_at' => $this->status === 'published' ? now() : null,
        ];

        if ($this->tutorial?->exists) {
            $this->tutorial->update($data);
            $this->tutorial->tags()->sync($this->selectedTags);
            $this->flashSuccess('Tutorial actualizado correctamente.');
        } else {
            $data['user_id'] = auth()->id();
            $tutorial = Tutorial::create($data);
            $tutorial->tags()->attach($this->selectedTags);
            $this->flashSuccess('Tutorial creado correctamente.');
        }

        $this->redirect(route('admin.tutorials.index'), navigate: true);
    }

    protected function rules(): array
    {
        $unique = $this->tutorial?->exists
            ? 'unique:tutorials,slug,' . $this->tutorial->id
            : 'unique:tutorials,slug';

        return [
            'title' => 'required|string|max:255',
            'slug' => "nullable|string|max:255|{$unique}",
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'series_id' => 'nullable|exists:tutorial_series,id',
            'order_in_series' => 'integer|min:0',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'duration_minutes' => 'nullable|integer|min:1|max:9999',
            'prerequisites' => 'nullable|string|max:500',
            'thumbnail' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'selectedTags' => 'array',
            'selectedTags.*' => 'exists:tags,id',
        ];
    }

    protected function view(): View
    {
        return view('livewire.admin.tutorial-form', [
            'seriesList' => TutorialSeries::orderBy('title')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }
}
