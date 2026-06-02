<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Livewire\Traits\WithListPagination;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: CategoryList
 *
 * Lista paginada de categorías con búsqueda y conteo de posts.
 * Previene eliminación de categorías con posts asociados.
 */
class CategoryList extends AdminComponent
{
    use WithListPagination;

    protected int $perPage = 20;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete(Category $category): void
    {
        if ($category->posts()->exists()) {
            $this->flashError('No se puede eliminar una categoría con posts asociados.');
            return;
        }

        $category->delete();
        $this->flashSuccess('Categoría eliminada correctamente.');
    }

    protected function view(): View
    {
        return view('livewire.admin.category-list', [
            'categories' => $this->applySearch(Category::query(), ['name', 'description'])
                ->withCount('posts')
                ->orderBy('name')
                ->paginate($this->perPage),
        ]);
    }
}
