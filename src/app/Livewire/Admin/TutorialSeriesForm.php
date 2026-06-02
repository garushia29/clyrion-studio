<?php

namespace App\Livewire\Admin;

use App\Models\TutorialSeries;
use App\Livewire\Traits\WithSlugGeneration;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: TutorialSeriesForm
 *
 * Formulario de creación y edición de series de tutoriales.
 * Auto-genera slug y soporta configuración de dificultad.
 */
class TutorialSeriesForm extends AdminComponent
{
    use WithSlugGeneration;

    public ?TutorialSeries $series = null;

    public string $title = '';
    public string $slug = '';
    public string $description = '';
    public string $thumbnail = '';
    public string $difficulty = 'intermediate';
    public int $sort_order = 0;
    public bool $is_active = true;

    public function mount(?TutorialSeries $series = null): void
    {
        if ($series?->exists) {
            $this->series = $series;
            $this->title = $series->title;
            $this->slug = $series->slug;
            $this->description = $series->description ?? '';
            $this->thumbnail = $series->thumbnail ?? '';
            $this->difficulty = $series->difficulty;
            $this->sort_order = $series->sort_order;
            $this->is_active = $series->is_active;
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
            'thumbnail' => $this->thumbnail,
            'difficulty' => $this->difficulty,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
        ];

        if ($this->series?->exists) {
            $this->series->update($data);
            $this->flashSuccess('Serie actualizada correctamente.');
        } else {
            TutorialSeries::create($data);
            $this->flashSuccess('Serie creada correctamente.');
        }

        $this->redirect(route('admin.series.index'), navigate: true);
    }

    protected function rules(): array
    {
        $unique = $this->series?->exists
            ? 'unique:tutorial_series,slug,' . $this->series->id
            : 'unique:tutorial_series,slug';

        return [
            'title' => 'required|string|max:255',
            'slug' => "nullable|string|max:255|{$unique}",
            'description' => 'nullable|string|max:1000',
            'thumbnail' => 'nullable|string|max:500',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    protected function view(): View
    {
        return view('livewire.admin.tutorial-series-form');
    }
}
