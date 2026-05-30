<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    protected $queryString = ['search', 'status'];

    public function delete(Post $post)
    {
        $post->delete();
    }

    public function render()
    {
        return view('livewire.admin.post-list', [
            'posts' => Post::query()
                ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
                ->when($this->status, fn($q) => $q->where('status', $this->status))
                ->orderByDesc('created_at')
                ->paginate(10),
        ])->layout('layouts.app');
    }
}
