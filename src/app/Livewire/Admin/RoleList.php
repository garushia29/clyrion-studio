<?php

namespace App\Livewire\Admin;

use App\Livewire\Traits\WithListPagination;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;

class RoleList extends AdminComponent
{
    use WithListPagination;

    protected int $perPage = 30;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete(Role $role): void
    {
        if ($role->name === 'super-admin') {
            $this->flashError('No se puede eliminar el rol super-admin.');
            return;
        }

        $role->delete();
        $this->flashSuccess('Rol eliminado correctamente.');
    }

    protected function view(): View
    {
        return view('livewire.admin.role-list', [
            'roles' => $this->applySearch(Role::query(), ['name'])
                ->withCount('users', 'permissions')
                ->orderBy('name')
                ->paginate($this->perPage),
        ]);
    }
}
