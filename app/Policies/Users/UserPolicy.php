<?php

namespace App\Policies\Users;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
}
