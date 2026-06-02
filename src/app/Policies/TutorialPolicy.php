<?php

namespace App\Policies;

use App\Models\Tutorial;
use App\Models\User;

class TutorialPolicy
{
    public function viewAny(User $user): bool { return $user->isAdmin(); }
    public function view(User $user, Tutorial $tutorial): bool { return $user->isAdmin(); }
    public function create(User $user): bool { return $user->isAdmin(); }
    public function update(User $user, Tutorial $tutorial): bool { return $user->isAdmin(); }
    public function delete(User $user, Tutorial $tutorial): bool { return $user->isAdmin(); }
}
