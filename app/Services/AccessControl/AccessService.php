<?php

namespace App\Services\AccessControl;

use App\Models\User;
use App\Services\Service;

class AccessService extends Service
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function grantPermission($userId, $name): void
    {
        $user = $this->find($userId);
        $user->givePermissionTo($name);
    }

    public function revokePermission($userId, $name): void
    {
        $user = $this->find($userId);
        $user->revokePermissionTo($name);
    }

    public function grantRole($userId, $name): void
    {
        $user = $this->find($userId);
        $user->assignRole($name);
    }

    public function revokeRole($userId, $name): void
    {
        $user = $this->find($userId);
        $user->removeRole($name);
    }

}
