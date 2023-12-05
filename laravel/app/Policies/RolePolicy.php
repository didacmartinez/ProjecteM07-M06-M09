<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Role;

class RolePolicy
{
    public function viewAny(User $user)
    {
        return $user->role_id === 3;
    }

    public function view(User $user, Role $role)
    {
        return $user->role_id === 3;
    }

    public function create(User $user)
    {
        return $user->role_id === 3;
    }

}
