<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Livewire\Traits\WithSlugGeneration;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: CategoryForm
 *
 * Formulario de creación y edición de categorías.
 * Soporta jerarquía padre-hijo y auto-generación de slug.
 */
class CategoryForm extends AdminComponent
{
    use WithSlugGeneration;

    public ?Category $category = null;

    public string $name = '';
    public string $slug = '';
    public string $description = '';
    public ?int $parent_id = null;

    public function mount(?Category $category = null): void
    {
        if ($category?->exists) {
            $this->category = $category;
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->description = $category->description ?? '';
            $this->parent_id = $category->parent_id;
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
            'description' => $this->description,
            'parent_id' => $this->parent_id,
        ];

        if ($this->category?->exists) {
            $this->category->update($data);
            $this->flashSuccess('Categoría actualizada correctamente.');
        } else {
            Category::create($data);
            $this->flashSuccess('Categoría creada correctamente.');
        }

        $this->redirect(route('admin.categories.index'), navigate: true);
    }

    protected function rules(): array
    {
        $unique = $this->category?->exists
            ? 'unique:categories,slug,' . $this->category->id
            : 'unique:categories,slug';

        return [
            'name' => 'required|string|max:255',
            'slug' => "nullable|string|max:255|{$unique}",
            'description' => 'nullable|string|max:500',
            'parent_id' => 'nullable|exists:categories,id',
        ];
    }

    protected function view(): View
    {
        return view('livewire.admin.category-form', [
            'parents' => Category::whereNull('parent_id')
                ->when($this->category, fn($q) => $q->where('id', '!=', $this->category->id))
                ->orderBy('name')
                ->get(),
        ]);
    }
}
