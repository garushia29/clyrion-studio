<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view services');
    }

    public function view(User $user, Service $service): bool
    {
        return $user->hasPermissionTo('view services');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create services');
    }

    public function update(User $user, Service $service): bool
    {
        return $user->hasPermissionTo('edit services');
    }

    public function delete(User $user, Service $service): bool
    {
        return $user->hasPermissionTo('delete services');
    }
}
