<?php

namespace App\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Permission;

class PermissionForm extends AdminComponent
{
    public ?Permission $permission = null;

    public string $name = '';

    public function mount(?Permission $permission = null): void
    {
        if ($permission?->exists) {
            $this->permission = $permission;
            $this->name = $permission->name;
        }
    }

    public function save(): void
    {
        $this->validate();

        $data = ['name' => $this->name, 'guard_name' => 'web'];

        if ($this->permission?->exists) {
            $this->permission->update($data);
            $this->flashSuccess('Permiso actualizado correctamente.');
        } else {
            Permission::create($data);
            $this->flashSuccess('Permiso creado correctamente.');
        }

        $this->redirect(route('admin.permissions.index'), navigate: true);
    }

    protected function rules(): array
    {
        $unique = $this->permission?->exists
            ? 'unique:permissions,name,' . $this->permission->id
            : 'unique:permissions,name';

        return [
            'name' => "required|string|max:255|{$unique}",
        ];
    }

    protected function view(): View
    {
        return view('livewire.admin.permission-form');
    }
}
