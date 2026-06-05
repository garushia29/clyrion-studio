<?php

namespace App\Livewire\Admin;

use App\Models\ActivityLog;
use App\Livewire\Traits\WithListPagination;
use Illuminate\Contracts\View\View;

class ActivityLogList extends AdminComponent
{
    use WithListPagination;

    public string $filterType = '';
    public string $filterModel = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterModel' => ['except' => ''],
    ];

    protected function view(): View
    {
        $query = ActivityLog::with('user');

        if ($this->filterType) {
            $query->where('log_type', $this->filterType);
        }

        if ($this->filterModel) {
            $query->where('model_type', $this->filterModel);
        }

        if ($this->search) {
            $query->where('description', 'like', "%{$this->search}%");
        }

        return view('livewire.admin.activity-log-list', [
            'logs' => $query->orderByDesc('created_at')->paginate(30),
            'modelTypes' => ActivityLog::distinct()->pluck('model_type')->map(fn($c) => class_basename($c))->unique()->sort()->values(),
        ]);
    }
}
