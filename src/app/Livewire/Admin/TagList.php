<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use App\Livewire\Traits\WithListPagination;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: TagList
 *
 * Lista paginada de etiquetas con búsqueda y conteo de usos.
 */
class TagList extends AdminComponent
{
    use WithListPagination;

    protected int $perPage = 30;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete(Tag $tag): void
    {
        $tag->posts()->detach();
        $tag->projects()->detach();
        $tag->delete();

        $this->flashSuccess('Tag eliminado correctamente.');
    }

    protected function view(): View
    {
        return view('livewire.admin.tag-list', [
            'tags' => $this->applySearch(Tag::query(), ['name'])
                ->withCount('posts')
                ->orderBy('name')
                ->paginate($this->perPage),
        ]);
    }
}
