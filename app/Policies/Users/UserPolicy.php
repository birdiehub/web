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

}
