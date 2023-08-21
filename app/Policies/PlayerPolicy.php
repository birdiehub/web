<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayerPolicy
{
    use HandlesAuthorization;

    public function viewPlayers(User $user): bool
    {
        return $user->hasPermissionTo('view-players-list');
    }

    public function viewPlayer(User $user): bool
    {
        return $user->hasPermissionTo('view-players-details');
    }

    public function editPlayer(User $user): bool
    {
        return $user->hasPermissionTo('edit-players');
    }

    public function deletePlayer(User $user): bool
    {
        return $user->hasPermissionTo('delete-players');
    }


    public function createPlayer(User $user): bool
    {
        return $user->hasPermissionTo('create-players');
    }


}
