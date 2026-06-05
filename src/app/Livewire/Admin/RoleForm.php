<?php

namespace App\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleForm extends AdminComponent
{
    public ?Role $role = null;

    public string $name = '';
    public array $selectedPermissions = [];

    public function mount(?Role $role = null): void
    {
        if ($role?->exists) {
            $this->role = $role;
            $this->name = $role->name;
            $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
        }
    }

    public function save(): void
    {
        $this->validate();

        $data = ['name' => $this->name, 'guard_name' => 'web'];

        if ($this->role?->exists) {
            $this->role->update($data);
            $this->role->syncPermissions($this->selectedPermissions);
            $this->flashSuccess('Rol actualizado correctamente.');
        } else {
            $role = Role::create($data);
            $role->syncPermissions($this->selectedPermissions);
            $this->flashSuccess('Rol creado correctamente.');
        }

        $this->redirect(route('admin.roles.index'), navigate: true);
    }

    protected function rules(): array
    {
        $unique = $this->role?->exists
            ? 'unique:roles,name,' . $this->role->id
            : 'unique:roles,name';

        return [
            'name' => "required|string|max:255|{$unique}",
            'selectedPermissions' => 'array',
        ];
    }

    protected function view(): View
    {
        return view('livewire.admin.role-form', [
            'permissions' => Permission::orderBy('name')->get()->groupBy(function ($p) {
                return explode(' ', $p->name)[1] ?? 'other';
            }),
        ]);
    }
}
