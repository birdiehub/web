<?php

namespace App\Policies\Users;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can be updated by the user.
     */
    public function update(User $user, User $other): bool
    {
        if ($user->hasPermissionTo('edit-users'))
            return true;
        elseif ($user->hasPermissionTo('edit-self'))
            return $user->id === $other->id;
        else
            return false;
    }
}
