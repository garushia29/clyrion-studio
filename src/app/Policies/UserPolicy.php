<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool { return $user->isAdmin(); }
    public function view(User $user, User $model): bool { return $user->isAdmin(); }
    public function create(User $user): bool { return $user->isAdmin(); }
    public function update(User $user, User $model): bool { return $user->isAdmin(); }
    public function delete(User $user, User $model): bool
    {
        if ($model->isAdmin() && User::admins()->count() <= 1) {
            return false;
        }
        return $user->isAdmin() && $user->id !== $model->id;
    }
}
