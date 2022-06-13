<?php

namespace App\Policies;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Role $role)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View roles');
    }

    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Create roles');
    }

    public function update(User $user, Role $role)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Update roles');
    }

    public function delete(User $user, Role $role)
    {
        if($role->id === 1)
        {
            return $this->deny('No se puede eliminar este role');
        }

        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete roles');
    }
}
