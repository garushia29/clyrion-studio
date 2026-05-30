<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectList extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    protected $queryString = ['search', 'status'];

    public function delete(Project $project)
    {
        $project->delete();
    }

    public function render()
    {
        return view('livewire.admin.project-list', [
            'projects' => Project::query()
                ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
                ->when($this->status, fn($q) => $q->where('status', $this->status))
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->paginate(10),
        ])->layout('layouts.app');
    }
}
