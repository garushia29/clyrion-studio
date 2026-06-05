<?php

namespace App\Livewire\Admin;

use App\Livewire\Traits\WithListPagination;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Permission;

class PermissionList extends AdminComponent
{
    use WithListPagination;

    protected int $perPage = 50;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete(Permission $permission): void
    {
        $permission->delete();
        $this->flashSuccess('Permiso eliminado correctamente.');
    }

    protected function view(): View
    {
        return view('livewire.admin.permission-list', [
            'permissions' => $this->applySearch(Permission::query(), ['name'])
                ->withCount('roles')
                ->orderBy('name')
                ->paginate($this->perPage),
        ]);
    }
}
