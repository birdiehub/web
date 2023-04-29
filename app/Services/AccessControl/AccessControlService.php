<?php

namespace App\Services\AccessControl;

use App\Models\User;
use App\Services\Service;
use App\Validators\Validator;

class AccessControlService extends Service
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function roles($userId)
    {
        $user = $this->_model->findOrFail($userId);
        return $user->getRoleNames();
    }

    public function permissions($userId)
    {
        $user = $this->_model->findOrFail($userId);
        return $user->getPermissionNames();
    }

    public function grantPermission($userId, $name): void
    {
        $user = $this->_model->findOrFail($userId);
        $user->givePermissionTo($name);
    }

    public function revokePermission($userId, $name): void
    {
        $user = $this->_model->findOrFail($userId);
        $user->revokePermissionTo($name);
    }

    public function grantRole($userId, $name): void
    {
        $user = $this->_model->findOrFail($userId);
        $user->assignRole($name);
    }

    public function revokeRole($userId, $name): void
    {
        $user = $this->_model->findOrFail($userId);
        $user->removeRole($name);
    }

}
