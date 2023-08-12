<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function viewPermissions(User $user): bool
    {
        return $user->hasPermissionTo('view-permissions-list');
    }

    public function viewPermission(User $user): bool
    {
        return $user->hasPermissionTo('view-permissions-details');
    }

}
