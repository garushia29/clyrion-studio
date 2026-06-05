<?php

namespace App\Policies;

use App\Models\Tutorial;
use App\Models\User;

class TutorialPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view tutorials');
    }

    public function view(User $user, Tutorial $tutorial): bool
    {
        return $user->hasPermissionTo('view tutorials');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create tutorials');
    }

    public function update(User $user, Tutorial $tutorial): bool
    {
        return $user->hasPermissionTo('edit tutorials');
    }

    public function delete(User $user, Tutorial $tutorial): bool
    {
        return $user->hasPermissionTo('delete tutorials');
    }
}
