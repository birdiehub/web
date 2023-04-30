<?php

namespace App\Http\Resources\Roles;

use App\Http\Resources\Permissions\PermissionCollection;
use App\Http\Resources\Resource;

class RoleResource extends Resource
{
    public function toArray($request) : array
    {
        return [
            'name' => $this->name,
            'permissions' => new PermissionCollection($this->permissions)
        ];
    }
}
