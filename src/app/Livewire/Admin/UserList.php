<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Livewire\Traits\WithListPagination;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: UserList
 *
 * Lista paginada de usuarios con búsqueda y eliminación.
 * Previene la eliminación del único administrador o de uno mismo.
 */
class UserList extends AdminComponent
{
    use WithListPagination;

    protected int $perPage = 30;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete(User $user): void
    {
        if ($user->isAdmin() && User::admins()->count() <= 1) {
            $this->flashError('No se puede eliminar el único administrador del sistema.');
            return;
        }

        if ($user->id === auth()->id()) {
            $this->flashError('No puedes eliminarte a ti mismo.');
            return;
        }

        $user->delete();
        $this->flashSuccess('Usuario eliminado correctamente.');
    }

    protected function view(): View
    {
        return view('livewire.admin.user-list', [
            'users' => $this->applySearch(User::query(), ['name', 'email'])
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage),
        ]);
    }
}
