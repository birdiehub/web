<?php

namespace App\Policies\AccessControl;

use Illuminate\Auth\Access\HandlesAuthorization;

class AccessPolicy
{
    // TODO: check if user has the permission himself before he can assign it to others
    // TODO: check if user has the permission himself before he can revoke it from others
    // TODO: super-admin can't be assigned or revoked

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
