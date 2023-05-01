<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class UserPolicy
{
    use HandlesAuthorization;


    public function viewUsers(User $user): bool
    {
        return $user->hasPermissionTo('view-users-list');
    }

    public function viewUser(User $user, User $other): bool
    {
        if ($user->hasPermissionTo('view-users-details')) {
            return true;
        }
        return $this->viewOwnUser($user, $other);
    }

    public function viewOwnUser(User $user, User $other): bool
    {
        if ($user->hasPermissionTo('view-own-user')) {
            return $user->id === $other->id;
        }
        return false;
    }

    public function editUser(User $user, User $other): bool
    {
        if ($user->hasPermissionTo('edit-users')) {
            return true;
        }
        return $this->editOwnUser($user, $other);
    }

    public function editOwnUser(User $user, User $other): bool
    {
        if ($user->hasPermissionTo('edit-own-user')) {
            return $user->id === $other->id;
        }
        return false;
    }

    public function deleteUser(User $user, User $other): bool
    {
        if ($user->hasPermissionTo('delete-users')) {
            return true;
        }
        return $this->deleteOwnUser($user, $other);
    }

    public function deleteOwnUser(User $user, User $other): bool
    {
        if ($user->hasPermissionTo('delete-own-user')) {
            return $user->id === $other->id;
        }
        return false;
    }

    public function createUser(User $user): bool
    {
        return $user->hasPermissionTo('create-users');
    }

    public function viewUserAccess(User $user): bool
    {
        return $user->hasPermissionTo('view-user-access');
    }

    public function grantUserPermission(User $user, string $permission): bool
    {
        // User must have grant user permission and the permission to be granted
        // Prevents giving himself permissions he doesn't have
        return $user->hasAllPermissions(['grant-user-permissions', $permission]);
    }

    public function revokeUserPermission(User $user, string $permission): bool
    {
        // User must have revoke user permission and the permission to be revoked
        // Prevents revoking permissions from others he doesn't have
        return $user->hasAllPermissions(['revoke-user-permissions', $permission]);
    }

    public function grantUserRole(User $user, string $roleName): bool
    {
        // User must have grant user role permission and the permissions of the role to be granted
        // Prevents giving himself roles (and permissions) he doesn't have
        $permissions = $this->rolePermissionsByName($roleName);
        $permissions[] = 'grant-user-roles';
        return $user->hasAllPermissions($permissions);
    }

    public function revokeUserRole(User $user, string $roleName): bool
    {
        // User must have revoke user role permission and the permissions of the role to be revoked
        // Prevents revoking roles (and permissions) from others he doesn't have
        $permissions = $this->rolePermissionsByName($roleName);
        $permissions[] = 'revoke-user-roles';
        return $user->hasAllPermissions($permissions);
    }

    private function rolePermissionsByName(string $roleName): array
    {
        return Role::findByName($roleName)->permissions->pluck('name');
    }

}
