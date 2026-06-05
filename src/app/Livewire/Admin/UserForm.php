<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserForm extends AdminComponent
{
    public ?User $user = null;

    public string $name = '';
    public string $email = '';
    public string $role = 'user';
    public string $password = '';
    public string $password_confirmation = '';
    public array $selectedRoles = [];

    public function mount(?User $user = null): void
    {
        if ($user?->exists) {
            $this->user = $user;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->selectedRoles = $user->roles->pluck('name')->toArray();
        }
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->user?->exists) {
            if ($this->user->isAdmin() && $this->role !== 'admin' && User::admins()->count() <= 1) {
                $this->flashError('Debe haber al menos un administrador en el sistema.');
                return;
            }
            $this->user->update($data);
            $this->user->syncRoles($this->selectedRoles);
            $this->flashSuccess('Usuario actualizado correctamente.');
        } else {
            $data['password'] = Hash::make($this->password);
            $user = User::create($data);
            $user->syncRoles($this->selectedRoles);
            $this->flashSuccess('Usuario creado correctamente.');
        }

        $this->redirect(route('admin.users.index'), navigate: true);
    }

    protected function rules(): array
    {
        $uniqueEmail = $this->user?->exists
            ? 'unique:users,email,' . $this->user->id
            : 'unique:users,email';

        $rules = [
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|{$uniqueEmail}",
            'role' => 'required|in:user,admin',
            'selectedRoles' => 'array',
        ];

        if ($this->user?->exists) {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        } else {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }

    protected function view(): View
    {
        return view('livewire.admin.user-form', [
            'roles' => Role::orderBy('name')->get(),
        ]);
    }
}
