<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolicy
{

    use HandlesAuthorization;

    public function viewRoles(User $user): bool
    {
        return $user->hasPermissionTo('view-roles-list');
    }

    public function viewRole(User $user): bool
    {
        return $user->hasPermissionTo('view-roles-details');
    }


    public function deleteRole(User $user, Role $role): bool
    {
        if ($role->name === 'super-admin') return false;
        return $user->hasPermissionTo('delete-roles');
    }


    public function createRole(User $user): bool
    {
        return $user->hasPermissionTo('create-roles');
    }

    public function grantRolePermission(User $user, Role $role): bool
    {
        if ($role->name === 'super-admin') return false;
        return $user->hasPermissionTo('grant-role-permissions');
    }

    public function revokeRolePermission(User $user, Role $role): bool
    {
        if ($role->name === 'super-admin') return false;
        return $user->hasPermissionTo('revoke-role-permissions');
    }

}
