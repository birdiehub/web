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

}
