<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use App\Livewire\Traits\WithSlugGeneration;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: TagForm
 *
 * Formulario de creación y edición de etiquetas.
 * Auto-genera slug a partir del nombre.
 */
class TagForm extends AdminComponent
{
    use WithSlugGeneration;

    public ?Tag $tag = null;

    public string $name = '';
    public string $slug = '';

    public function mount(?Tag $tag = null): void
    {
        if ($tag?->exists) {
            $this->tag = $tag;
            $this->name = $tag->name;
            $this->slug = $tag->slug;
            $this->autoSlug = false;
        }
    }

    public function updatedName(string $value): void
    {
        $this->updatedTitleAutoSlug($value);
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->resolveSlug($this->name, $this->slug),
        ];

        if ($this->tag?->exists) {
            $this->tag->update($data);
            $this->flashSuccess('Tag actualizado correctamente.');
        } else {
            Tag::create($data);
            $this->flashSuccess('Tag creado correctamente.');
        }

        $this->redirect(route('admin.tags.index'), navigate: true);
    }

    protected function rules(): array
    {
        $unique = $this->tag?->exists
            ? 'unique:tags,slug,' . $this->tag->id
            : 'unique:tags,slug';

        return [
            'name' => 'required|string|max:255',
            'slug' => "nullable|string|max:255|{$unique}",
        ];
    }

    protected function view(): View
    {
        return view('livewire.admin.tag-form');
    }
}
