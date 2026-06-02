<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Livewire\Traits\WithListPagination;

/**
 * Livewire Component: PostList
 *
 * Lista paginada de posts con búsqueda y filtro
 * por estado (draft/published).
 */
class PostList extends AdminComponent
{
    use WithListPagination;

    protected int $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function delete(Post $post): void
    {
        $post->delete();
        $this->flashSuccess('Post eliminado correctamente.');
    }

    protected function view(): \Illuminate\Contracts\View\View
    {
        return view('livewire.admin.post-list', [
            'posts' => $this->applySearch(Post::query(), ['title'])
                ->tap(fn($q) => $this->applyStatusFilter($q))
                ->orderByDesc('created_at')
                ->paginate($this->perPage),
        ]);
    }
}
